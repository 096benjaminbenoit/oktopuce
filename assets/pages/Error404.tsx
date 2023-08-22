import React from "react";
/** @ts-ignore */
import Illustration from '../components/Illustration';
import NavBar from "../components/NavBar";

export default function Error404(){
    return (
    <>
        {/* AJOUTER LA NAVBAR */}
        <NavBar></NavBar>
        <section className='error404 d-flex flex-column align-items-center p-3'>
            <Illustration className='illustration404 img-fluid m-5'/>
            <h2 className="title404 text-uppercase">Erreur 404</h2>
            <p className="quote404 m-3">Oups ! Il semblerait que cette page ne soit pas disponible, revenez plus tard.</p>
        </section>
    </>
    );
}