import React from 'react';
import NavBar from '../components/NavBar';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';

type InfosUserForm = {
  name: string;
  address: string;
  city: string;
  postCode: string;
  phoneNumber: string;
  email: string;
  prestataire: {
      name: string;
      phoneNumber: string;
      email: string;
  }
}

export default function SiteList() {

  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
  } = useForm<InfosUserForm>()

  return (<>
    <NavBar></NavBar>

    <section className='siteListContainer d-flex flex-column justify-content-around'>
      
      <h1 className='titleInfosUser text-uppercase m-2'>Sites enregistrés</h1>
      
      <ul className="siteList m-5">
        <li className='site site1'>Maison Perso</li> 
        <li className='site site2'>Bureau</li>
      </ul>


      <Button.Link path='/site' className='text-uppercase btnInfosUser m-5' variant="primary"> Ajouter un site </Button.Link>
    </section>
    </>
  );
}