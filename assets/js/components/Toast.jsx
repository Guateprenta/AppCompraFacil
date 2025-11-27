export default function Toast({ shown, type, children, ...props }) {
    return (
        <div
            className="toast z-99"
            style={{
                opacity: shown ? 1 : 0,
                transition: "opacity 1s ease-out",
            }}>
            <div className={`alert ${type}`}>{children}</div>
        </div>
    )
}
