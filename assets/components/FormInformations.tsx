import React from 'react';
import Form from 'react-bootstrap/Form';
import { Link } from 'react-router-dom';
import Checkbox from './Checkbox';
import Input from './Input';
import Radio from './Radio';
import Select from './Select';
import Button from './Button';
import NavBar from './NavBar';

function FormInformations() {
  return (
    <>
      <NavBar></NavBar>
      
      <Input></Input>
      <Radio options={[]}></Radio>
      <Select aria-label="Type" options={[]}></Select>
      <Link to={''}></Link>
      <Checkbox></Checkbox>
      <Select options={[{
          label: "Bonjour",
          value: "bjr"
      }]}/>
      <Link to={''}></Link>
      <Button variant={''}></Button>
    </>
  );
}

export default FormInformations;