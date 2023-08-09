import React from "react";
/** @ts-ignore */
import Illustration from '../components/Illustration';

export default function scanPage(){
    return (
    <>
        {/* AJOUTER LA NAVBAR */}
        <section className='error404'>
            {/* Mettre la marge sur le parent du h1 quand elle sera dans la navBar */}
            <h1 className='homeTitle text-uppercase m-3'>Oktopuce</h1>
            <Illustration className='illustration404 img-fluid'/>
        </section>
    </>
    );
}