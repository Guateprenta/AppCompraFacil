import { useState } from "react";

function SimpleButton({ onClick, children }) {
    return (
        <button className="btn btn-accent" onClick={onClick}>
            {children}
        </button>
    );
}

const hello = () => {
    const [count, setCount] = useState(0);

    return (
        <main className="container mx-auto my-3">
            <h1 className="text-3xl font-bold mb-3">Hello world from React!</h1>
            <p className="text-2xl mb-3">
                Count: <strong>{count}</strong>
            </p>
            <div className="flex flex-row gap-3">
                <SimpleButton onClick={() => setCount((prev) => prev + 1)}>
                    Add +
                </SimpleButton>
                <SimpleButton onClick={() => setCount((prev) => prev - 1)}>
                    Substract -
                </SimpleButton>
                <div className="toast">
                    <div className="alert alert-info">
                        <span>New message arrived.</span>
                    </div>
                </div>
            </div>
        </main>
    );
};

export default hello;
