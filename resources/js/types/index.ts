export type * from './auth';
export type * from './navigation';
export type * from './ui';

export interface AuthUser {
    id: number;
    username: string;
    email: string;
    role_id: number;
    role: string;
}

export interface SharedData {
    auth: {
        user: AuthUser | null;
    };
}

export interface masaKhidmat {
    id: number;
    name: string;
    coba: string;
}
export interface role {
    id: number;
    name: string;
}

export interface user {
    id: number;
    name: string;
    email: string;
    role_id: number;
    role: role;
}
