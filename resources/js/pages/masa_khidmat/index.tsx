import React from 'react';
import { Head } from '@inertiajs/react';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { index as masaKhidmatIndex } from '@/routes/masa-khidmat';
import { masaKhidmat } from "@/types";

export default function MasaKhidmatIndex({ coba }: masaKhidmat) {
    console.log(coba);
    console.log('RENDER DASHBOARD');

    return (
        <>
            <div>
                <Head title="Masa Khidmat" />
                <h1 className="text-2xl font-bold">Masa Khidmat</h1>
                <p className="mt-2 text-gray-600">This is the Masa Khidmat index page.</p>
            </div>
        </>
    )
}
MasaKhidmatIndex.layout = {
    breadcrumbs: [
        {
            title: 'Masa Khidmat',
            href: masaKhidmatIndex.url(), // Menghasilkan string '/masa-khidmat'
        },
    ],
};

