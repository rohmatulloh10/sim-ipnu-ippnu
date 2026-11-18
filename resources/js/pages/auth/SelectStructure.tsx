import { Head, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';

type Assignment = {
    id: number;
    role_id: number;
    id_struktur: number;
    role: {
        id: number;
        nama_role: string;
    };
};

type Props = {
    assignments: Assignment[];
};

export default function SelectStructure({ assignments }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        assignment_id: '',
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/pilih-struktur');
    };

    return (
        <>
            <Head title="Pilih Role" />

            <form onSubmit={submit} className="flex flex-col gap-6">
                <div className="grid gap-3">
                    {assignments.map((assignment) => {
                        const isSelected =
                            data.assignment_id === String(assignment.id);

                        return (
                            <label
                                key={assignment.id}
                                className={`flex cursor-pointer items-start gap-3.5 rounded-lg border p-4 text-sm transition-colors ${
                                    isSelected
                                        ? 'border-primary bg-primary/5 ring-primary ring-1'
                                        : 'border-input bg-background hover:bg-accent/50'
                                }`}
                            >
                                <input
                                    type="radio"
                                    name="assignment_id"
                                    value={assignment.id}
                                    checked={isSelected}
                                    onChange={(e) =>
                                        setData('assignment_id', e.target.value)
                                    }
                                    className="accent-primary mt-1 size-4"
                                />

                                <div className="grid gap-1 leading-none">
                                    <span className="text-foreground font-medium">
                                        {assignment.role?.nama_role ??
                                            'Role tidak ditemukan'}
                                    </span>
                                    <span className="text-muted-foreground text-xs">
                                        Struktur #{assignment.id_struktur}
                                    </span>
                                </div>
                            </label>
                        );
                    })}

                    <InputError message={errors.assignment_id} />
                </div>

                <Button
                    type="submit"
                    className="w-full"
                    disabled={!data.assignment_id || processing}
                >
                    {processing && <Spinner />}
                    Lanjutkan ke Dashboard
                </Button>
            </form>
        </>
    );
}

SelectStructure.layout = {
    title: 'Pilih Role',
    description:
        'Akun kamu memiliki beberapa penugasan. Pilih role dan struktur organisasi yang ingin digunakan',
};
