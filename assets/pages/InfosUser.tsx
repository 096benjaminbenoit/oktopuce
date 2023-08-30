import React from 'react';
import NavBar from '../components/NavBar';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';
import FormInformations from '../components/FormInformations';

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

export default function Informations() {

  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
  } = useForm<InfosUserForm>()

  return (<>
    <NavBar></NavBar>

    <section className='infosUser d-flex flex-column'>
      <h1 className='titleInfosUser m-2'>Nouveau Profil</h1>

    <div className='formInfosContainer m-3'>
      <FormInformations/>
    </div>

      <Button.Link path='/infos' className='text-uppercase btnInfosUser mb-3 ' variant="primary">Valider</Button.Link>
    </section>
    </>
  );
}