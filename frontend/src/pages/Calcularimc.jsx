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

  const calcularIMC = () => {
    if (!peso || !altura) {
      alert("Por favor completa peso y altura");
      return;
    }

    const alturaMetros = altura / 100;
    const imc = (peso / (alturaMetros * alturaMetros)).toFixed(2);

    setResultado(imc);
  };

  return (
    <div className="imc-container">

      {/* HEADER */}
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


      {/* CARD */}
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

        <button className="btn-calcular" onClick={calcularIMC}>
          CALCULAR
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