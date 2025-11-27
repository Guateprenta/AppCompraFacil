export default function Login({
    error: initialError = null,
    email: initialEmail = "",
}) {
    return (
        <div className="min-h-screen bg-gradient-to-br from-green-700 via-green-900 to-emerald-800 flex items-center justify-center p-4">
            <div className="card bg-base-100 shadow-xl w-full max-w-5xl border-4 border-emerald-600 dark:border-emerald-300 grid grid-cols-1 md:grid-cols-2">
                <div className="relative bg-white p-8 flex items-center justify-center h-64 md:h-auto">
                    <img
                        src="images/fondo2tikal.png"
                        alt="Logo Casa de Empeño"
                        fill
                        className="object-contain"
                    />
                </div>

                <div className="card-body bg-base-200 dark:bg-base-100">
                    <h2 className="text-2xl font-bold text-center mb-4">
                        <i className="fas fa-key mr-2"></i> Bienvenido
                    </h2>

                    <form method="POST" action="/login" className="space-y-8">
                        <label className="form-control w-full mb-3">
                            <div className="label">
                                <span className="label-text">
                                    <i className="fas fa-user mr-2"></i> Usuario
                                </span>
                            </div>
                            <input
                                type="text"
                                name="email"
                                defaultValue={initialEmail}
                                placeholder="Ingrese su usuario"
                                className="input input-success w-full"
                            />
                        </label>

                        <label className="form-control w-full mb-2">
                            <div className="label">
                                <span className="label-text">
                                    <i className="fas fa-lock mr-2"></i>{" "}
                                    Contraseña
                                </span>
                            </div>
                            <input
                                type="password"
                                name="password"
                                placeholder="Ingrese su contraseña"
                                className="input input-success w-full"
                            />
                        </label>

                        {initialError && (
                            <p className="text-red-500">{initialError}</p>
                        )}

                        <button
                            type="submit"
                            className="btn btn-secondary w-full mt-8">
                            <i className="fas fa-door-open mr-2"></i> Entrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    )
}
