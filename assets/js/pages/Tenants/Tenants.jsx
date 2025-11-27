import React from "react"
import PanelLayout from "../../layouts/PanelLayout.jsx"

export default function Tenants({ tenants }) {
    return (
        <PanelLayout>
            <div className="flex flex-col items-center justify-start min-h-screen bg-base-100 p-6">
                <h1 className="text-2xl font-bold text-emerald-700 ">
                    Lista de Empresas
                </h1>
                <div className="flex gap-2 mt-4">
                    <button className="btn btn-primary btn-sm ">
                        Regresar
                    </button>
                    <button className="btn btn-accent btn-sm">
                        <i className="fas fa-plus mr-1"></i> Agregar
                    </button>
                    <button className="btn btn-secondary btn-sm">
                        <i className="fas fa-file-excel mr-1"></i> Excel
                    </button>
                    <button className="btn bg-rose-800 text-white btn-sm">
                        <i className="fas fa-print mr-1"></i> PDF
                    </button>
                </div>

                <div className="flex flex-col md:flex-row items-center gap-2 mt-4 w-full max-w-5xl">
                    <input
                        type="text"
                        placeholder="Buscar por usuario"
                        className="input input-sm input-bordered w-full md:flex-1"
                    />
                    <select className="select select-sm w-36">
                        <option value={10}>10</option>
                        <option value={25}>25</option>
                        <option value={50}>50</option>
                        <option value={75}>75</option>
                        <option value={100}>100</option>
                    </select>
                </div>

                <div className="overflow-x-auto rounded-box border border-base-content/5 mt-5 w-full max-w-5xl">
                    <table className="table table-zebra w-full text-sm">
                        <thead className="bg-emerald-700 text-white">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Fecha Inicio</th>
                            </tr>
                        </thead>
                        <tbody className="text-center">
                            {tenants.map((t) => (
                                <tr key={t.idTenant}>
                                    <td>{t.idTenant}</td>
                                    <td>{t.nombre}</td>
                                    <td>{t.email}</td>
                                    <td>{t.telefono}</td>
                                    <td>{t.direccion}</td>
                                    <td>{t.fechaInicio}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </PanelLayout>
    )
}
