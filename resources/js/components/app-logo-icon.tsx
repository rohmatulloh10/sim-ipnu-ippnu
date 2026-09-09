import type { SVGAttributes } from "react";

export default function AppLogoIcon(props: React.ImgHTMLAttributes<HTMLImageElement>) {
    return (
        <img
            {...props}
            src="/storage/img/logo.png"   // atau logo.png
            alt="App Logo"
        />
    );
}
