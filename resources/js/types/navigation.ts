import type { InertiaLinkProps } from '@inertiajs/react';
import type { LucideIcon } from 'lucide-react';

export type BreadcrumbItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
};

export type NavSubItem = {
    subtitle: string
    subhref: NonNullable<InertiaLinkProps['href']>;
    subicon?: any
}

export type NavItem = {
    title: string;
    href?: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon | null;
    subitems?: NavSubItem[];
    isActive?: boolean;
};
