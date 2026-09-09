import { useState } from "react";
import { Link } from "@inertiajs/react";
import {
    SidebarMenu,
    SidebarMenuItem,
    SidebarMenuButton,
    SidebarMenuSub,
    SidebarMenuSubItem,
} from "@/components/ui/sidebar";
import { useCurrentUrl } from "@/hooks/use-current-url";
import type { NavItem } from "@/types";

export function NavMain({ items }: { items: NavItem[] }) {
    const { isCurrentUrl } = useCurrentUrl();
    const [openItem, setOpenItem] = useState<string | null>(null);

    return (
        <SidebarMenu>
            {items.map((item) => {
                const isOpen = openItem === item.title;

                return (
                    <SidebarMenuItem key={item.title}>
                        <SidebarMenuButton
                            asChild={!!item.href}
                            isActive={item.href ? isCurrentUrl(item.href) : false}
                            tooltip={{ children: item.title }}
                            onClick={() =>
                                item.subitems
                                    ? setOpenItem(isOpen ? null : item.title)
                                    : undefined
                            }
                        >
                            {item.href ? (
                                <Link href={item.href} prefetch>
                                    {item.icon && <item.icon />}
                                    <span>{item.title}</span>
                                </Link>
                            ) : (
                                <>
                                    {item.icon && <item.icon />}
                                    <span>{item.title}</span>
                                </>
                            )}
                        </SidebarMenuButton>

                        {/* Submenu awalnya hidden, muncul kalau isOpen true */}
                        {item.subitems && isOpen && (
                            <SidebarMenuSub>
                                {item.subitems.map((sub) => (
                                    <SidebarMenuSubItem key={sub.subtitle}>
                                        <SidebarMenuButton
                                            asChild
                                            isActive={isCurrentUrl(sub.subhref)}
                                            tooltip={{ children: sub.subtitle }}
                                        >
                                            <Link href={sub.subhref} prefetch>
                                                {sub.subicon && <sub.subicon />}
                                                <span>{sub.subtitle}</span>
                                            </Link>
                                        </SidebarMenuButton>
                                    </SidebarMenuSubItem>
                                ))}
                            </SidebarMenuSub>
                        )}
                    </SidebarMenuItem>
                );
            })}
        </SidebarMenu>
    );
}
