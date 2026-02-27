import { BrowserRouter, Routes, Route } from "react-router-dom";
import { AuthProvider } from "./context/AuthContext";
import ProtectedRoute from "./routes/ProtectedRoute";

import Home from "./pages/Home.jsx";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Dashboard from "./pages/Dashboard";
import Tienda from "./pages/tienda"; 
import CalcularIMC from "./pages/Calcularimc";
import Planes from "./pages/Planes";

function App() {
  return (
    
    <AuthProvider>
      <BrowserRouter>
        <Routes>

          <Route path="/" element={<Home />} />

          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route path="/productos" element={<Tienda />} />

          <Route
            path="/dashboard"
            element={
              <ProtectedRoute>
                <Dashboard />
              </ProtectedRoute>
            }
          />

          <Route path="/tienda" element={<Tienda />} />

          <Route path="/calcular-imc" element={<CalcularIMC />} />

          <Route path="/planes" element={<Planes />} />

        </Routes>
      </BrowserRouter>
    </AuthProvider>
  );
}

export default App;

