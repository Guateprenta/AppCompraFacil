const Input = (props) => {
    return (
        <fieldset className="fieldset">
            <legend className="fieldset-legend">{props.label}</legend>
            <input
                type="text"
                className="input input-bordered w-full"
                {...props}
            />
            {props.error && (
                <span className="fieldset-label text-error">{props.error}</span>
            )}
        </fieldset>
    )
}

export default Input
