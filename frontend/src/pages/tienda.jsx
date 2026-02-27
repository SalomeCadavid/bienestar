import React from "react";
import { useNavigate } from "react-router-dom";
import "./Tienda.css";
import logo from "../assets/TB.png"; 
const productos = [
  {
    nombre: "Proteína Whey",
    descripcion: "Suplemento ideal para aumentar masa muscular.",
    precio: "$120.000",
    imagen: "/imagenes/proteina-whey.png",
  },
  {
    nombre: "Creatina Monohidratada",
    descripcion: "Aumenta fuerza, energía y rendimiento.",
    precio: "$75.000",
    imagen: "/imagenes/creatina.png",
  },
  {
    nombre: "Pre-entreno 330g",
    descripcion: "Mejora energía y concentración.",
    precio: "$75.000",
    imagen: "/imagenes/Pre-entreno.jpg",
  },
  {
    nombre: "Colágeno Hidrolizado",
    descripcion: "Fortalece piel, cabello y articulaciones.",
    precio: "$36.300",
    imagen: "/imagenes/colageno.png",
  },
  {
    nombre: "Glutamina 300g",
    descripcion: "Recuperación muscular avanzada.",
    precio: "$85.300",
    imagen: "/imagenes/Glutamina.png",
  },
  {
    nombre: "Avena Proteica",
    descripcion: "Desayuno saludable y nutritivo.",
    precio: "$30.000",
    imagen: "/imagenes/Avena.png",
  },
  {
    nombre: "Proteína Whey Chocolate",
    descripcion: "Suplemento ideal para aumentar masa muscular, con un delicioso sabor a Chocolate.",
    precio: "$145.000",
    imagen: "/imagenes/chocolate.png",
  },

  {
    nombre: "Crema de Maní",
    descripcion: "Wakeup Crema De Maní Natural 360g",
    precio: "$25.000",
    imagen: "/imagenes/crema.png",
  },
  {
    nombre: "Bebida Detox",
    descripcion: "Mezcla Munsa elixir Green 250g",
    precio: "$45.000",
    imagen: "/imagenes/detox.png",
  },
  {
    nombre: "Bebida Fit Detox",
    descripcion: "Batido verde Fit Prime sabor frutos verdes 210g.",
    precio: "$65.000",
    imagen: "/imagenes/batido-verde.png",
  },
  {
    nombre: "Stevia",
    descripcion: "Endulzante Natural De Stevia 500g",
    precio: "$32.000",
    imagen: "/imagenes/endulzante.png",
  },
  {
    nombre: "Termo 1L Acero",
    descripcion: "Perfecto para hidratación constante.",
    precio: "$39.000",
    imagen: "/imagenes/termo-1l.png",
  },
  
  {
    nombre: "Bandas Elásticas",
    descripcion: "Set deportivo x5 resistencias.",
    precio: "$39.000",
    imagen: "/imagenes/Bandas.webp",
  },
  {
    nombre: "Guantes Deportivos",
    descripcion: "Guantes Jerk Sportfitness.",
    precio: "$60.000",
    imagen: "/imagenes/guantes.png",
  },
  {
    nombre: "Bandas Elásticas",
    descripcion: "Set de Bandas Elásticas en Tela Sportfitness",
    precio: "$40.000",
    imagen: "/imagenes/Bandas-tela.webp",
  },
  {
    nombre: "Camiseta Hombre",
    descripcion: "Camiseta deportiva para hombre NEGRO.",
    precio: "$37.000",
    imagen: "/imagenes/camiseta.webp",
  },
  {
    nombre: "Conjunto Mujer",
    descripcion: "Conjunto deportivo de top sin mangas de unicolor y pantalones para mujer.",
    precio: "$51.000",
    imagen: "/imagenes/conjunto.webp",
  },
  {
    nombre: "Calcetines Deportivos",
    descripcion: "9 pares de calcetines deportivos de media caña, cortos, largos y de corte alto..",
    precio: "$60.000",
    imagen: "/imagenes/calcetines.webp",
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