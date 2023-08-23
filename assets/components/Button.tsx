import React from "react";
import { Link } from "react-router-dom";

type ButtonProps = {
    children?: React.ReactNode;
    variant: string;
    className?: string;
    type?: "button" | "submit" | "reset" | undefined; 
    onClick?: (event: React.MouseEvent) => void;
    // path?: string; 
};

export default function Button({children, variant, className = "", type = "button", onClick}: ButtonProps) {
    // if (path) {
    //     return <Link style={{display: "contents"}} to={path}><button className={`btn btn-${variant} ${className}`}>{ children }</button></Link>;
    // }

    return (
        // Autre façon d'écrire les variables : {"btn btn-" + variant + " " + className}
        <button type={type} className={`btn btn-${variant} ${className}`} onClick={onClick}>{ children }</button>
    );
}
// "...rest" permet de copier les arguments d'un composant a un sous composant 
// omit permet de retirer des propriétés à un type
Button.Link = function({path, ...rest}: Omit<ButtonProps, "type"> & {path: string}) {
    return <Link style={{display: "contents"}} to={path}><Button {...rest}/></Link>
}