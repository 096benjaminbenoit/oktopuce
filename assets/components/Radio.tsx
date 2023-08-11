import React from 'react';
import Form from 'react-bootstrap/Form';
import InputGroup from 'react-bootstrap/InputGroup';

function Radio(props) {
  return (
    <>
      <InputGroup className="mb-3">
        <InputGroup.Radio aria-label="Radio button for following text input" />
        <Form.Control {...props} aria-label="Text input with radio button" />
      </InputGroup>
    </>
  );
}

export default Radio;