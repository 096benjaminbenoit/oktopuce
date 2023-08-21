import React from 'react';
import Form from 'react-bootstrap/Form';
import { Link } from 'react-router-dom';
import Checkbox from './Checkbox';
import Input from './Input';
import Radio from './Radio';
import Select from './Select';

function FormInformations() {
  return (
    <>
        <Select options={[{
            label: "Bonjour",
            value: "bjr"
        }]}/>        
    </>
  );
}

export default FormInformations;