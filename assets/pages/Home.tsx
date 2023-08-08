import React from 'react';
/** @ts-ignore */
import Button from '../components/Button';
import Logo from '../components/Logo';

export default function Home(){
    return (<>

        <section className='d-flex flex-column align-items-center'>
            <Logo className="mb-5"></Logo>
            <Button className='mb-3' variant="primary" text="J'ai un compte"/>
            <Button variant="primary" text="Je n'ai pas de compte"/>
        </section>
        </>
    );
}