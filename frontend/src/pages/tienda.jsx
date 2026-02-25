import React from "react";
import { useNavigate } from "react-router-dom";
import "./Tienda.css";
import logo from "../assets/TB.png"; // Asegúrate que exista este logo

const productos = [
  {
    nombre: "Proteína Whey",
    descripcion: "Suplemento ideal para aumentar masa muscular.",
    precio: "$120.000",
    imagen: "/images/whey.png",
  },
  {
    nombre: "Creatina Monohidratada",
    descripcion: "Aumenta fuerza, energía y rendimiento.",
    precio: "$75.000",
    imagen: "/images/creatina.png",
  },
  {
    nombre: "Pre-entreno 330g",
    descripcion: "Mejora energía y concentración.",
    precio: "$75.000",
    imagen: "/images/preentreno.png",
  },
  {
    nombre: "Colágeno Hidrolizado",
    descripcion: "Fortalece piel, cabello y articulaciones.",
    precio: "$36.300",
    imagen: "/images/colageno.png",
  },
  {
    nombre: "Glutamina 300g",
    descripcion: "Recuperación muscular avanzada.",
    precio: "$85.300",
    imagen: "/images/glutamina.png",
  },
  {
    nombre: "Avena Proteica",
    descripcion: "Desayuno saludable y nutritivo.",
    precio: "$30.000",
    imagen: "/images/avena.png",
  },
  {
    nombre: "Termo 1L Acero",
    descripcion: "Perfecto para hidratación constante.",
    precio: "$39.000",
    imagen: "/images/termo.png",
  },
  {
    nombre: "Bandas Elásticas",
    descripcion: "Set deportivo x5 resistencias.",
    precio: "$39.000",
    imagen: "/images/bandas.png",
  },
];

const Tienda = () => {
  const navigate = useNavigate();

  return (
    <div className="tienda-container">

      {/* Barra Blanca Superior */}
      <div className="barra-superior">
        <img src={logo} alt="BT" className="logo-bt" />

        <button
          className="home-btn"
          onClick={() => navigate("/")}
        >
          BIENESTAR TOTAL
        </button>

        <img src={logo} alt="BT" className="logo-bt" />
      </div>

      {/* Título */}
      <h2 className="titulo-tienda">Tienda - Bienestar Total</h2>

      {/* Grid de Productos */}
      <div className="productos-grid">
        {productos.map((producto, index) => (
          <div key={index} className="producto-card">
            <img src={producto.imagen} alt={producto.nombre} />
            <h3>{producto.nombre}</h3>
            <p>{producto.descripcion}</p>
            <span className="precio">{producto.precio}</span>
            <button className="comprar-btn">Comprar</button>
          </div>
        ))}
      </div>

    </div>
  );
};

export default Tienda;