import { useQuery } from "@tanstack/react-query";

export interface NfcTag {
    "@context": string;
    "@id":      string;
    "@type":    string;
    equipment:  Equipment;
}

export interface Equipment {
    equipmentType: string | { "@id": string; };
    "@id":            string;
    "@type":          string;
    id:               number;
    serialNumber:     string;
    // equipment:        any[];
    nfcTag:           string;
    brand:            string;
    gas:              Gas;
    hasLeakDetection: boolean;
    finality:         any[];
    interventions:    Intervention[];
}

export interface Gas {
    "@id":   string;
    "@type": string;
    name:    string;
}

export interface Intervention {
    "@id":            string;
    "@type":          string;
    interventionDate: Date;
    interventionType: {type: string};
}

function useNFCRaw<T>(nfcTag: string, transform: (data: NfcTag) => T) {
    return useQuery({
        queryKey: ['nfc_tags', nfcTag],
        queryFn: ({ queryKey: [type, id] }) => fetch(`/api/${type}/${id}.jsonld`).then(
            async (res) => await res.json() as NfcTag
        ),
        select: transform
    });
}

export function useNFC(nfcTag: string) {
    return useNFCRaw(nfcTag, tag => tag);
}

export function useEquipment(nfcTag: string) {
    return useNFCRaw(nfcTag, tag => tag.equipment);
}
