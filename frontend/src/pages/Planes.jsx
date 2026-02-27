import { useNavigate } from "react-router-dom";
import "./Planes.css";
import logo from "../assets/TB.png"; 

function Planes() {
  const navigate = useNavigate();

  return (
    <div className="planes-container">

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

      {/* BOTÓN CALCULAR IMC */}
      <button
        className="btn-imc"
        onClick={() => navigate("/calcular-imc")}
      >
        CALCULAR TU IMC
      </button>

      {/* CARDS */}
      <div className="planes-grid">

        <div className="plan-card">
          <h3>PLAN AUMENTO DE MASA</h3>
          <p>Con este plan tienes acceso a dietas personalizadas.</p>
          <button>SIGUIENTE</button>
        </div>

        <div className="plan-card">
          <h3>PLAN MANTENIMIENTO</h3>
          <p>Con este plan tienes acceso a rutinas personalizadas.</p>
          <button>SIGUIENTE</button>
        </div>

        <div className="plan-card">
          <h3>PLAN PERDIDA DE GRASA</h3>
          <p>Con este plan tienes acceso a todos los planes, rutinas y dietas.</p>
          <button>SIGUIENTE</button>
        </div>

        <div className="plan-card">
          <h3>PLAN CONTROL INTENSIVO</h3>
          <p>Incluye monitoreo continuo, ajustes semanales y acompañamiento personalizado.</p>
          <button>SIGUIENTE</button>
        </div>

      </div>

      <footer>© 2025 BIENESTAR TOTAL.</footer>
    </div>
  );
}

export default Planes;