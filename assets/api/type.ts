export interface Client {
    "@id": string;
    "@type": "Client";
    id: number;
    address: string;
    postCode: string;
    city: string;
    phone: string;
    email: string;
    sites: any[];
}
export interface EquipementType {
    "@context": "string";
    "@id": "string";
    "@type": "string";
    id: number;
    type: string;
    equipment: string[];
}
export type Equipment = {
    "@context": string,
    "@id": string,
    "@type": string,
    "id": number,
    "installationDate": "2023-08-29T12:52:33.579Z",
    "serialNumber": string,
    "parent": string,
    "equipment": [
      string
    ],
    "nfcTag": {
      "@context": string,
      "@id": string,
      "@type": string,
      "equipment": string
    },
    "brand": string,
    "location": string,
    "locationDetail": string,
    "equipmentType": {
      "@context": "string",
      "@id": "string",
      "@type": "string",
      "type": "string"
    },  "placement": string,
    "remoteNumber": string,
    "gas": {
      "@context": string,
      "@id": string,
      "@type": string,
      "name": string
    },
    "gasWeight": number,
    "hasLeakDetection": true,
    "lastLeakDetection": "2023-08-29T12:52:33.580Z",
    "nextLeakDetection": "2023-08-29T12:52:33.580Z",
    "finality": [
      string
    ],
    "capacity": number,
    "picto": string,
    "interventions": [
      {
        "@context": string,
        "@id": string,
        "@type": string,
        "interventionDate": "2023-08-29T12:52:33.580Z"
      }
    ]
  }
export type Site = {
    "id": number,
    "address": string,
    "city": string,
    "postCode": string,
    "name": string,
    "client": string,
    "contacts": [
      string,
    ]
  }