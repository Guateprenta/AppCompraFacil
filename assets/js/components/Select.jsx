const Select = ({ error, label, ...props }) => {
    return (
        <fieldset className="fieldset">
            <legend className="fieldset-legend">{label}</legend>
            <select className="select select-bordered w-full" {...props}>
                <option value="" disabled>
                    -----
                </option>
                {props.children}
            </select>
            {error && (
                <span className="fieldset-label text-error">{error}</span>
            )}
        </fieldset>
    )
}

export default Select
