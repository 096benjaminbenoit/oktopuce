
export function getId(p: string|{"@id": string}): string {
    if (typeof p == "string") return p;
    return p["@id"];
}

export function getList<T>(p: T[]|{"hydra:member": T[]}): T[] {
    if (Array.isArray(p)) return p;
    return p["hydra:member"];
}

export function getQueryKey(s: string) {
    let keys = s.split(/\/+/).filter(s => s != "");
    if (keys[0] == "api") return keys.slice(1);
}