import React from "react";
import { useNavigate } from "react-router-dom";
import "./Home.css";
import mancuerna from "../assets/mancuerna.png"; // coloca aquí tu imagen


const Home = () => {
  const navigate = useNavigate();

  return (
    <div className="home-container">

      {/* Header */}
      <header className="home-header">
        <div className="logo">BT</div>
    
        <div className="nav-buttons">
          <button className="productos-btn"onClick={() => navigate("/productos")}>TIENDA</button>
          <button onClick={() => navigate("/recomendaciones")}>RECOMENDACIONES</button>
          <button onClick={() => navigate("/nosotros")}>NOSOTROS</button>
          <button className="register-btn"onClick={() => navigate("/register")}>¡REGÍSTRATE AHORA!</button>
        </div>

        <div className="logo">BT</div>
      </header>

      {/* Main Section */}
      <main className="home-main">
        <div className="text-section">
          <h1>
            ¡TE ACOMPAÑAMOS EN <br />
            CADA PASO HACIA TÚ <br />
            MEJOR VERSIÓN!
          </h1>

          <p>
            ALCANZA TUS OBJETIVOS Y MEJORA TUS HÁBITOS <br />
            CON BIENESTAR TOTAL.
          </p>
        </div>

        <div className="image-section">
          <img src={mancuerna} alt="Mancuerna" />
        </div>
      </main>

      {/* Footer */}
      <footer className="home-footer">
        © 2025 BIENESTAR TOTAL.
      </footer>

    </div>
  );
};

export default Home;
