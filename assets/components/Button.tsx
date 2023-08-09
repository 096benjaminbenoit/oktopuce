import React from "react";



type ButtonProps = {
    children?: React.ReactNode;
    variant: string;
    className?: string;
};

export default function Button({children, variant, className = ""}: ButtonProps) {
    return (
        // Autre façon d'écrire les variables : {"btn btn-" + variant + " " + className}
        <button className={`btn btn-${variant} ${className}`}>{ children }</button>
    );
}
