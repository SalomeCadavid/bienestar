const API_URL = "http://localhost:8000/api";

export async function apiFetch(endpoint, options = {}) {
  const token = localStorage.getItem("token");

  const isFormData = options.body instanceof FormData;

  const res = await fetch(API_URL + endpoint, {
    ...options,
    credentials: "include", // importante si usas Sanctum
    headers: {
      ...(isFormData ? {} : { "Content-Type": "application/json" }),
      Accept: "application/json",
      ...(token && { Authorization: `Bearer ${token}` }),
      ...(options.headers || {}),
    },
  });

  if (!res.ok) {
    const text = await res.text();
    console.error("API ERROR:", text);

    if (res.status === 401) {
      localStorage.removeItem("token");
      window.location.href = "/login";
    }

    throw new Error(text || "Error en la petición");
  }

  return res.json();
}