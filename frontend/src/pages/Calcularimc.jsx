import { useState } from "react";
import { useNavigate } from "react-router-dom";
import "./CalcularIMC.css";
import logo from "../assets/TB.png";

function CalcularIMC() {
  const navigate = useNavigate();

  const [genero, setGenero] = useState("");
  const [edad, setEdad] = useState("");
  const [peso, setPeso] = useState("");
  const [altura, setAltura] = useState("");
  const [resultado, setResultado] = useState(null);
  const [loading, setLoading] = useState(false);

  const calcularIMC = async () => {
    if (!peso || !altura) {
      alert("Por favor completa peso y altura");
      return;
    }

    try {
      setLoading(true);

      const response = await fetch(
        "http://localhost:8000/api/usuarios/calcular-imc",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            genero,
            edad,
            peso,
            estatura: altura, // 👈 importante que coincida con Laravel
          }),
        }
      );

      const data = await response.json();

      if (!response.ok) {
        console.error(data);
        alert("Error al calcular IMC");
        return;
      }

      // 🔥 El IMC lo devuelve el backend
      setResultado(data.imc);

    } catch (error) {
      console.error("Error:", error);
      alert("Error de conexión con el servidor");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="imc-container">

      <div className="header">
        <img src={logo} alt="logo" className="logo" />
        <button
          className="home-btn"
          onClick={() => navigate("/")}
        >
          BIENESTAR TOTAL
        </button>
        <img src={logo} alt="logo" className="logo" />
      </div>

      <div className="card">
        <h2>CALCULAR IMC</h2>

        <input
          type="text"
          placeholder="GENERO"
          value={genero}
          onChange={(e) => setGenero(e.target.value)}
        />

        <input
          type="number"
          placeholder="EDAD"
          value={edad}
          onChange={(e) => setEdad(e.target.value)}
        />

        <input
          type="number"
          placeholder="PESO (kg)"
          value={peso}
          onChange={(e) => setPeso(e.target.value)}
        />

        <input
          type="number"
          placeholder="ALTURA (cm)"
          value={altura}
          onChange={(e) => setAltura(e.target.value)}
        />

        <button 
          className="btn-calcular" 
          onClick={calcularIMC}
          disabled={loading}
        >
          {loading ? "Calculando..." : "CALCULAR"}
        </button>

        {resultado && (
          <div className="resultado">
            Tu IMC es: <strong>{resultado}</strong>
          </div>
        )}
      </div>

      <footer>© 2025 BIENESTAR TOTAL.</footer>
    </div>
  );
}

export default CalcularIMC;