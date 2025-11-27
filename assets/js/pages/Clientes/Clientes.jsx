import React, { useState } from "react"
import { router } from "@inertiajs/react"
import PanelLayout from "../../layouts/PanelLayout.jsx"
import Modal from "../../components/Modal.jsx"
import Input from "../../components/Input.jsx"
import Alert from "../../components/Alert.jsx"

export default function Clientes({ clientes }) {
    const [isModalOpen, setModalOpen] = useState(false)

    const [mode, setMode] = useState("create")

    const [selectedId, setSelectedId] = useState(null)

    const [alert, setAlert] = useState({
        shown: false,
        type: "success",
        message: "",
    })

    const [form, setForm] = useState({
        nombre: "",
        apellido: "",
        email: "",
        telefono: "",
        direccion: "",
        dpi: "",
    })

    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        })
    }

    const saveCliente = () => {
        if (mode === "create") {
            router.post("/clientes/nuevo", form, {
                onSuccess: () => {
                    closeModal()
                    setAlert({
                        shown: true,
                        type: "success",
                        message: "Cliente registrado exitosamente.",
                    })
                    setTimeout(() => {
                        setAlert((a) => ({ ...a, shown: false }))
                    }, 2500)
                },
            })
        } else {
            router.patch(`/clientes/${selectedId}`, form, {
                onSuccess: () => {
                    closeModal()
                    setAlert({
                        shown: true,
                        type: "warning",
                        message: "Cliente actualizado exitosamente.",
                    })
                    setTimeout(() => {
                        setAlert((a) => ({ ...a, shown: false }))
                    }, 2500)
                },
            })
        }
    }

    const openEditModal = (cliente) => {
        setMode("edit")
        setSelectedId(cliente.id)
        setForm({
            nombre: cliente.nombre,
            apellido: cliente.apellido,
            email: cliente.email,
            telefono: cliente.telefono,
            direccion: cliente.direccion,
            dpi: cliente.dpi,
        })
        setModalOpen(true)
    }

    const closeModal = () => {
        setModalOpen(false)
        setMode("create")
        setSelectedId(null)
        setForm({
            nombre: "",
            apellido: "",
            email: "",
            telefono: "",
            direccion: "",
            dpi: "",
        })
    }

    return (
        <PanelLayout>
            <div className="flex flex-col items-center justify-start h-full bg-base-100 ">
                <h1 className="text-2xl font-bold mb-4 text-emerald-700">
                    Clientes
                </h1>

                <div className="flex gap-2 mt-4">
                    <button
                        onClick={() => setModalOpen(true)}
                        className="btn btn-accent btn-sm">
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
                    <select className="select select-sm w-32">
                        <option value={10}>10</option>
                        <option value={25}>25</option>
                        <option value={50}>50</option>
                        <option value={75}>75</option>
                        <option value={100}>100</option>
                    </select>
                </div>
                <Alert
                    shown={alert.shown}
                    type={alert.type}
                    message={alert.message}
                />

                <div className="overflow-x-auto rounded-box border border-base-content/5 mt-5 w-full max-w-5xl">
                    <table className="table table-zebra w-full text-sm">
                        <thead className="bg-emerald-700 text-white text-center">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Direccion</th>
                                <th>DPI</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody className="text-center">
                            {clientes.map((c) => (
                                <tr key={c.id}>
                                    <td>{c.id}</td>
                                    <td>{c.nombre}</td>
                                    <td>{c.apellido}</td>
                                    <td>{c.email}</td>
                                    <td>{c.telefono}</td>
                                    <td>{c.direccion}</td>
                                    <td>{c.dpi}</td>
                                    <td className="flex gap-2 items-center justify-center">
                                        <button
                                            className="btn btn-warning btn-xs"
                                            onClick={() => openEditModal(c)}>
                                            <i className="fas fa-edit"></i>
                                        </button>
                                        <button
                                            className="btn btn-error btn-xs"
                                            onClick={() =>
                                                router.delete(
                                                    `/clientes/${c.id}`,
                                                    {
                                                        onSuccess: () => {
                                                            setAlert({
                                                                shown: true,
                                                                type: "error",
                                                                message:
                                                                    "Cliente eliminado exitosamente.",
                                                            })
                                                            setTimeout(() => {
                                                                setAlert(
                                                                    (a) => ({
                                                                        ...a,
                                                                        shown: false,
                                                                    }),
                                                                )
                                                            }, 2500)
                                                        },
                                                    },
                                                )
                                            }>
                                            <i className="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                {/* Modal Agregar */}
                <Modal
                    title={
                        mode === "create" ? "Agregar Cliente" : "Editar Cliente"
                    }
                    isOpen={isModalOpen}
                    onClose={() => setModalOpen(false)}
                    onSave={saveCliente}>
                    <Input
                        label="Nombre"
                        name="nombre"
                        placeholder="nombre"
                        value={form.nombre}
                        onChange={handleChange}
                    />
                    <Input
                        label="Apellido"
                        name="apellido"
                        placeholder="Apellido"
                        value={form.apellido}
                        onChange={handleChange}
                    />
                    <Input
                        label="Email"
                        name="email"
                        placeholder="Correo"
                        value={form.email}
                        onChange={handleChange}
                    />
                    <Input
                        label="Telefono"
                        name="telefono"
                        placeholder="Teléfono"
                        value={form.telefono}
                        onChange={handleChange}
                    />
                    <Input
                        label="Direccion"
                        name="direccion"
                        placeholder="Dirección"
                        value={form.direccion}
                        onChange={handleChange}
                    />
                    <Input
                        label="DPI*"
                        name="dpi"
                        placeholder="DPI"
                        value={form.dpi}
                        onChange={handleChange}
                    />
                </Modal>
            </div>
        </PanelLayout>
    )
}
