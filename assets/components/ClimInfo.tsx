import React, { useState, useEffect } from 'react';
import Form from 'react-bootstrap/Form';
import Button from './Button';
import { useForm } from 'react-hook-form';

const initialData = {
  installationDate: '',
  serialNumber: '',
  brand: { id: '', name: '' },
  locationDetail: '',
  remoteNumber: '',
  gas: { name: '' },
  gasWeight: 0,
  capacity: 0,
  picto: '',
};

function getId(obj) {
  if (typeof obj == "string") return obj;
  return obj["@id"];
}

function filterDataForForm(data) {
  return Object.fromEntries(
    Object.keys(initialData).map(k => [k, data[k]])
  )
}

function ClimInfo() {
  const { register, handleSubmit, reset } = useForm();
  const [brands, setBrands] = useState([]);
  const [gas, setGas] = useState([]);
  const [climData, setClimData] = useState(initialData);

  const onSubmit = data => {
    
    handleUpdate(data);
    console.log(data);
  };

  useEffect(() => {
    const fetchBrand = fetch('http://127.0.0.1:8000/api/brands')
      .then(response => response.json())
      .then(data => {
        setBrands(data['hydra:member']);
      });


      fetchBrand.catch(error => {
        console.error('Error fetching brands:', error);
      });
  
    const fetchGas = fetch('http://127.0.0.1:8000/api/gas_types')
      .then(response => response.json())
      .then(data => {
        setGas(data['hydra:member']);
      });

      fetchGas.catch(error => {
        console.error('Error fetching gas types:', error);
      });
      Promise.all([fetchBrand, fetchGas]).then(() => {
        fetch('http://127.0.0.1:8000/api/equipment/1')
        .then(response => response.json())
        .then(data => {
          setClimData(data);
          reset(filterDataForForm({
            ...data,
            brand: getId(data.brand),
            gas: getId(data.gas),
            location: data.locationDetail,
          }));
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
      });

  }, [reset]);
  


  const handleUpdate = (data) => {
    fetch('/api/equipment/1', {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/merge-patch+json',
      },
      body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(updatedData => {
    })
    .catch(error => {
      console.error('Error updating data:', error);
    });
  };
  

  return (
    <Form className="d-contents" onSubmit={handleSubmit(onSubmit)}>
      <img
        src="https://www.medicis-patrimoine.com/media/cache/post_show/uploads/post/climatisation-peut-on-l-installer-sans-rien-demander.jpg"
        alt="Image Alt Text"
        style={{ maxWidth: '50%', height: 'auto', margin: '8px' }}
      />
      <h2 className="m-3 homeTitle text-uppercase">Clim test</h2>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Installation Date</Form.Label>
        <Form.Control
          type="text"
          {...register('installationDate')}
          defaultValue={climData.installationDate}
        />
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Serial Number</Form.Label>
        <Form.Control
          type="text"
          {...register('serialNumber')}
          defaultValue={climData.serialNumber}
        />
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Brand Name</Form.Label>
        <select {...register('brand')}>
          {brands.map(brand => (
            <option key={brand["@id"]} value={brand["@id"]}>
              {brand.name}
            </option>
          ))}
        </select>
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Location Detail</Form.Label>
        <Form.Control
          type="text"
          {...register('locationDetail')}
          defaultValue={climData.locationDetail}
        />
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Remote Number</Form.Label>
        <Form.Control
          type="text"
          {...register('remoteNumber')}
          defaultValue={climData.remoteNumber}
        />
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
      <Form.Label>Brand Name</Form.Label>
        <select {...register('gas')}>
        {gas.map(gasItem => (
          <option key={gasItem["@id"]} value={gasItem["@id"]}>
            {gasItem.name}
          </option>
          ))}
        </select>
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Gas Weight</Form.Label>
        <Form.Control
          type="text"
          {...register('gasWeight')}
          defaultValue={climData.gasWeight}
        />
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Capacity</Form.Label>
        <Form.Control
          type="text"
          {...register('capacity')}
          defaultValue={climData.capacity}
        />
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Picto</Form.Label>
        <Form.Control
          type="text"
          {...register('picto')}
          defaultValue={climData.picto}
        />
      </Form.Group>

      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Button type="submit" className="mt-5" variant="primary">
          Modifier
        </Button>
      </Form.Group>
    </Form>
  );
}

export default ClimInfo;


// import React, { useState, useEffect } from 'react';
// import Form from 'react-bootstrap/Form';
// import Button from './Button';
// import { useForm } from 'react-hook-form';

// function ClimInfo() {
// const { register, handleSubmit,reset } = useForm();
// const onSubmit = data => console.log(data);
// const [climData, setClimData] = useState(null);


  

//   useEffect(() => {
//     fetch('http://127.0.0.1:8000/api/equipment/1')
//       .then(response => response.json())
//       .then(data => {
//         setClimData(data);
//         reset(data)
//       })
//       .catch(error => {
//         console.error('Error fetching data:', error);
//       });
//   }, [reset]);
//   useEffect(() => {
//     console.log(setClimData);
//   }, [setClimData]);
  

//   return (
//     <Form className="d-contents"  onSubmit={handleSubmit(onSubmit)}>
//       <img
//         src="https://www.medicis-patrimoine.com/media/cache/post_show/uploads/post/climatisation-peut-on-l-installer-sans-rien-demander.jpg"
//         alt="Image Alt Text"
//         style={{ maxWidth: '50%', height: 'auto', margin: '8px' }}
//       />
//       <h2 className="m-3 homeTitle text-uppercase">Clim test</h2>
      
//       <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//   <Form.Label>Serial Number</Form.Label>
//   <Form.Control
//     type="text"
//     {...register('serialNumber')}
//     defaultValue={climData ? climData.serialNumber : ''}
//   />
// </Form.Group>

// <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//   <Form.Label>Brand Name</Form.Label>
//   <Form.Control
//     type="text"
//     {...register('brand')}
//     defaultValue={climData ? climData.brand.name : ''}
//   />
// </Form.Group>

// <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//   <Form.Label>Location Detail</Form.Label>
//   <Form.Control
//     type="text"
//     {...register('location')}
//     defaultValue={climData ? climData.locationDetail : ''}
//   />
// </Form.Group>

// <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//   <Form.Label>Remote Number</Form.Label>
//   <Form.Control
//     type="text"
//     {...register('remoteNumber')}
//     defaultValue={climData ? climData.remoteNumber : ''}
//   />
// </Form.Group>

// <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//   <Form.Label>Gas Name</Form.Label>
//   <Form.Control
//     type="text"
//     {...register('gas')}
//     defaultValue={climData ? climData.gas.name : ''}
//   />
// </Form.Group>

// <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//   <Form.Label>Gas Weight</Form.Label>
//   <Form.Control
//     type="text"
//     {...register('gasWeight')}
//     defaultValue={climData ? climData.gasWeight : ''}
//   />
// </Form.Group>

// <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//   <Form.Label>Capacity</Form.Label>
//   <Form.Control
//     type="text"
//     {...register('capacity')}
//     defaultValue={climData ? climData.capacity : ''}
//   />
// </Form.Group>

// <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//   <Form.Label>Picto</Form.Label>
//   <Form.Control
//     type="text"
//     {...register('picto')}
//     defaultValue={climData ? climData.picto : ''}
//   />
// </Form.Group>
      
//       <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
//         <Button type="submit" className="mt-5" variant="primary">
//           Modifier
//         </Button>
//       </Form.Group>
//     </Form>
//   );
// }

// export default ClimInfo;
