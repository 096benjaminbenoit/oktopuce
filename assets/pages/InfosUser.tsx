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
    <section>
      <div className="container text-center mt-4">
        <h1>Nouveau Profil</h1>
      </div>
      <div className="container mt-4 mb-4">
        <div className="card mx-auto" style={{ maxWidth: "500px" }}>
          <div className="card-body">
            <div className='formInfosContainer m-3'>
              <FormInformations />
            </div>
          </div>
          <div className="container text-center mt-3">
            <Button type="submit" className='text-uppercase btnHome mb-3' variant="primary">Valider</Button>
          </div>
        </div>
      </div>
    </section>
  </>
  );
}