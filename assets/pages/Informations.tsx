import React from 'react';
import Form from 'react-bootstrap/Form';
import NavBar from '../components/NavBar';
import Checkbox from '../components/Checkbox';
import Input from '../components/Input';
import { Link } from "react-router-dom";
import Radio from '../components/Radio';
import Select from '../components/Select';

export default function Informations() {
  return (<>
    <NavBar></NavBar>
    <Form>
        <Checkbox></Checkbox>
        <Input></Input>
        {/* <Radio></Radio> */}
        {/* <Select options={undefined} defaultValue={undefined} onChange={undefined}></Select> */}
        <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
            <Form.Label>Email address</Form.Label>
            <Form.Control type="email" placeholder="name@example.com" />
        </Form.Group>
        <Form.Group className="mb-3" controlId="exampleForm.ControlTextarea1">
            <Form.Label>Example textarea</Form.Label>
            <Form.Control as="textarea" rows={3} />
        </Form.Group>
        <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
            <Form.Label>Email address</Form.Label>
            <Form.Control type="email" placeholder="name@example.com" />
        </Form.Group>
        <Link to={''}></Link>
      </Form>
    </>
  );
}