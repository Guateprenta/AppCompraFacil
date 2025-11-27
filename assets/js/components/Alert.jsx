export default function Alert({ type = "info", message, shown }) {
    const typeClasses = {
        success: "alert-success",
        error: "alert-error",
        warning: "alert-warning",
        info: "alert-info",
    }

    return (
        <div
            className={`fixed inset-0 flex items-center justify-center z-[9999] transition-opacity duration-300 ${
                shown ? "opacity-100" : "opacity-0 pointer-events-none"
            }`}>
            <div className={`alert shadow-lg w-auto ${typeClasses[type]}`}>
                {type === "success" && (
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-6 w-6 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                )}
                {type === "error" && (
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-6 w-6 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                )}
                {type === "warning" && (
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-6 w-6 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M12 9v2m0 4h.01M5.07 19h13.86L12 5 5.07 19z"
                        />
                    </svg>
                )}
                {type === "info" && (
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-6 w-6 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 110-16 8 8 0 010 16z"
                        />
                    </svg>
                )}

                <span>{message}</span>
            </div>
        </div>
    )
}
