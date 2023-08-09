import React from "react";
/** @ts-ignore */
import illustration from '../images/illustration404.svg';

export default function Illustration({className = ''}) {
    return (

        <img src={ illustration } alt="Page erreur, poulpe vert qui coupe l'alimentation d'un plongeur"  className={ className }></img>
    );
}