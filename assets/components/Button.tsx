import React from "react";
import { Link } from "react-router-dom";



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
// "...rest" permet de copier les arguments d'un composant a un sous composant 
Button.Link = function({path, ...rest}: ButtonProps & {path: string}) {
    return <Link style={{display: "contents"}} to={path}><Button {...rest}/></Link>
}