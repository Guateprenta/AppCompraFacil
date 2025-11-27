import React from "react"

export default function Drawer({ children, toggleId = "main-drawer", user }) {
    return (
        <div className="drawer">
            {/* Checkbox controlador */}
            <input
                id={toggleId}
                type="checkbox"
                className="drawer-toggle peer"
            />

            {/* CONTENIDO PRINCIPAL */}
            <div className="drawer-content">
                {/* BOTÓN HAMBURGUESA — DESAPARECE AL ABRIR EL DRAWER */}
                <label
                    htmlFor={toggleId}
                    className="
                        menu-button btn btn-secondary fixed top-4 left-4 z-50
                        peer-checked:hidden
                    ">
                    ☰
                </label>

                {/* PAGE CONTENT */}
                <div className="pt-16 px-4">{children}</div>
            </div>

            {/* DRAWER SIDE */}
            <div className="drawer-side">
                <label htmlFor={toggleId} className="drawer-overlay"></label>

                <ul className="menu bg-emerald-800 text-white min-h-full w-65 p-4 text-base">
                    {/* Avatar */}
                    <li className="mb-4 flex flex-col items-center">
                        <div className="avatar">
                            <div className="w-20 rounded-full ring ring-white">
                                <img
                                    src={
                                        user?.avatar ??
                                        "https://i.pravatar.cc/150"
                                    }
                                    alt="Avatar"
                                />
                            </div>
                        </div>
                        <p className="font-bold mt-2">{user?.email}</p>
                    </li>

                    {/* LINEA SEPARADORA */}
                    <div className="divider my-2"></div>

                    {/* MENU ITEMS CON ICONOS */}
                    <li>
                        <a href="/panel">
                            <i className="fas fa-desktop w-5 mr-3"></i> Panel
                        </a>
                    </li>

                    <li>
                        <a href="/usuarios">
                            <i className="fas fa-users w-5 mr-3"></i> Usuarios
                        </a>
                    </li>

                    <li>
                        <a href="/empresas">
                            <i className="fas fa-building w-5 mr-3"></i> Tenants
                        </a>
                    </li>

                    <li>
                        <a href="/roles">
                            <i className="fas fa-id-card w-5 mr-3"></i> Roles
                        </a>
                    </li>
                    <li>
                        <a href="/clientes">
                            <i class="fa-solid fa-users w-5 mr-3"></i> Clientes
                        </a>
                    </li>
                    {/* OTRO SEPARADOR */}
                    <div className="divider my-2"></div>

                    <li>
                        <a href="/configuracion">
                            <i className="fas fa-cog w-5 mr-3"></i>{" "}
                            Configuración
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    )
}
