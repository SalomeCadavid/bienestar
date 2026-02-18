import "./Home.css";
import mancuerna from "../assets/mancuerna.png"; // coloca aquí tu imagen

function Home() {
  return (
    <div className="home">

      {/* NAVBAR */}
      <nav className="navbar">
        <div className="logo">BT</div>

        <ul className="nav-links">
          <li>Tienda</li>
          <li>Nuestros Planes</li>
          <li>Recomendaciones</li>
          <li>Nosotros</li>
          <li className="btn-register">Regístrate Ahora</li>
        </ul>

        <div className="logo">BT</div>
      </nav>

      {/* HERO */}
      <section className="hero">
        <div className="hero-text">
          <h1>
            ¡TE ACOMPAÑAMOS <br />
            EN CADA PASO <br />
            HACIA TU MEJOR <br />
            <span>VERSIÓN!</span>
          </h1>
        </div>

        <div className="hero-image">
          <img src={mancuerna} alt="Mancuerna" />
        </div>
      </section>

    </div>
  );
}

export default Home;
