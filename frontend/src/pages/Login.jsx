import "./Login.css";
import { useNavigate } from "react-router-dom";

function Login() {
  const navigate = useNavigate();

  return (
    <div className="login-container">

      {/* HEADER */}
      <header className="login-header">
        <div className="logo">BT</div>
        <div className="title">BIENESTAR TOTAL</div>
        <div className="logo">BT</div>
      </header>

      {/* VOLVER */}
      <div className="back-button">
        <button onClick={() => navigate("/register")}>
          Volver al registro
        </button>
      </div>

      {/* CARD */}
      <div className="login-card">
        <h2>INICIA SESIÓN</h2>

        <input type="email" placeholder="CORREO ELECTRÓNICO" />
        <input type="password" placeholder="CONTRASEÑA" />

        <div className="login-footer">
          <span className="forgot">¿Olvidaste tu contraseña?</span>

          <button className="btn-primary">
            SIGUIENTE
          </button>
        </div>
      </div>

      {/* FOOTER */}
      <footer className="footer">
        © 2025 BIENESTAR TOTAL
      </footer>

    </div>
  );
}

export default Login;

