import React from 'react';
import NavBar from '../components/NavBar';
import { Link } from 'react-router-dom';
import Checkbox from '../components/Checkbox';
import Input from '../components/Input';
import Radio from '../components/Radio';
import Select from '../components/Select';
import Form from 'react-bootstrap/esm/Form';
import Button from '../components/Button';


export default function Informations() {
  return (<>
    <NavBar></NavBar>

      {/* Pull les modifs de Steph sur l'input */}
      <Input label="Langue"></Input>
      <Select options={[  ]}></Select>
      <Input label="Nom"></Input>
      <Input label="Prénom"></Input>
      <Input label="N° et nom de la rue"></Input>
      <Input label="Code postal"></Input>
      <Input label="Ville"></Input>
      <Input label="Téléphone"></Input>
      <Input label="Mail"></Input>
      
      <Button variant={''}>Valider</Button>
    </>
  );
}