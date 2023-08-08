import React from "react";

export default function Button({text, variant, className = ""}) {
    return (
        // Autre façon d'écrire les variables : {"btn btn-" + variant + " " + className}
        <button className={`btn btn-${variant} ${className}`}>{ text }</button>
    );
}