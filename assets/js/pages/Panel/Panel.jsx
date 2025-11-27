import React from "react"
import PanelLayout from "../../layouts/PanelLayout.jsx"

export default function Panel({ users }) {
    return (
        <PanelLayout>
            <h1 className="text-2xl font-bold mb-4 text-purple-600 text-center">
                Panel de Usuarios
            </h1>

            <table className="min-w-full border">
                <thead>
                    <tr className="bg-green-400">
                        <th className="p-2 border">ID</th>
                        <th className="p-2 border">Email</th>
                        <th className="p-2 border">Roles</th>
                        <th className="p-2 border">Tenant</th>
                    </tr>
                </thead>
                <tbody>
                    {users.map((u) => (
                        <tr key={u.id}>
                            <td className="p-2 border">{u.id}</td>
                            <td className="p-2 border">{u.email}</td>
                            <td className="p-2 border">{u.roles.join(", ")}</td>
                            <td className="p-2 border">{u.tenant}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </PanelLayout>
    )
}
