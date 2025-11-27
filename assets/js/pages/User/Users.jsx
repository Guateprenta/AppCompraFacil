import React, { useEffect, useState } from "react"
import Drawer from "../../components/Drawer"

export default function Users() {
    const [users, setUsers] = useState([])

    useEffect(() => {
        fetch("/api/users")
            .then((r) => r.json())
            .then((data) => {
                console.log("Usuarios cargados:", data)
                setUsers(data)
            })
            .catch((err) => console.error("Error cargando usuarios:", err))
    }, [])

    return (
        <Drawer>
            <div className="flex flex-col items-center justify-start min-h-screen bg-base-100 p-6">
                <h1 className="text-2xl font-bold text-emerald-700">
                    Usuarios
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
                        <thead className="bg-emerald-700 text-white text-center">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Usuario</th>
                                <th>Tenant</th>
                            </tr>
                        </thead>

                        <tbody className="text-center">
                            {users.map((u) => (
                                <tr key={u.id}>
                                    <td>{u.id}</td>
                                    <td>{u.email}</td>
                                    <td>{u.username}</td>
                                    <td>{u.tenant_id}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </Drawer>
    )
}
