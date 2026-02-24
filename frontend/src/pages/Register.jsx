import "./Register.css";
import { useNavigate } from "react-router-dom";

function Register() {
  const navigate = useNavigate();

  return (
    <div className="register-container">

      {/* HEADER */}
      <header className="register-header">
        <div className="logo">BT</div>
        <div className="title">BIENESTAR TOTAL</div>
        <div className="logo">BT</div>
      </header>

      {/* CARD */}
      <div className="register-card">
        <h2>REGÍSTRATE</h2>

        <input type="email" placeholder="CORREO ELECTRÓNICO" />
        <input type="password" placeholder="CONTRASEÑA" />
        <input type="text" placeholder="NOMBRE DE USUARIO" />

        <button className="btn-primary">SIGUIENTE</button>
      </div>

      {/* LOGIN LINK */}
      <div className="login-section">
        <p>¿YA TE HAS REGISTRADO?</p>
        <button
          className="btn-secondary"
          onClick={() => navigate("/login")}
        >
          INICIA SESIÓN
        </button>
      </div>

      {/* FOOTER */}
      <footer className="footer">
        © 2025 BIENESTAR TOTAL
      </footer>

    </div>
  );
}

export default Register;
