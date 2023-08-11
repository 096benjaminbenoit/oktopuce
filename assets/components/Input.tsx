import Form from 'react-bootstrap/Form';
import InputGroup from 'react-bootstrap/InputGroup';

function Input(props) {
  return (
    <>
      <InputGroup className="mb-3">
        <InputGroup.Text id="inputGroup-sizing-default">
          Default
        </InputGroup.Text>
        <Form.Control {...props}
          aria-label="Default"
          aria-describedby="inputGroup-sizing-default"
        />
      </InputGroup>
    </>
  );
}

export default Input;