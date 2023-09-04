import React from "react";
import { Link } from "react-router-dom";

type ButtonProps = {
    children?: React.ReactNode;
    variant: 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info' | 'dark' | 'light' | (string & {});
    className?: string;
    type?: "button" | "submit" | "reset" | undefined; 
    onClick?: (event: React.MouseEvent) => void;
    path?: string; 
} & React.ButtonHTMLAttributes<HTMLButtonElement>;

export default function Button({children, variant, className = "", type = "button", ...rest}: ButtonProps) {
    return (
        // Autre façon d'écrire les variables : {"btn btn-" + variant + " " + className}
        <button className={`btn btn-${variant} ${className}`} type={type} {...rest} >{ children }</button>
    );
}
// "...rest" permet de copier les arguments d'un composant a un sous composant 
// omit permet de retirer des propriétés à un type
Button.Link = function({path, ...rest}: Omit<ButtonProps, "type"> & {path: string}) {
    return <Link style={{display: "contents"}} to={path}><Button type="button" {...rest}/></Link>
}