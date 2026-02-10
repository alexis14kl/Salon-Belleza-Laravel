<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Glamour Studio - Salón de belleza profesional. Cortes, coloración, manicure, tratamientos capilares, maquillaje y más. Reserva tu cita hoy.">
    <title>Glamour Studio | Salón de Belleza</title>

    <meta property="og:type" content="website">
    <meta property="og:title" content="Glamour Studio | Salón de Belleza">
    <meta property="og:description" content="Tu destino de belleza y bienestar. Servicios profesionales de estilismo, coloración, manicure y más.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold: #c9a84c;
            --gold-light: #e0c97f;
            --gold-dark: #a8872e;
            --black: #1a1a1a;
            --black-light: #2d2d2d;
            --white: #ffffff;
            --white-off: #faf8f5;
            --pink: #f5e6e0;
            --pink-dark: #e8cfc5;
            --gray: #888888;
            --gray-light: #f0ede8;

            --font-heading: 'Playfair Display', Georgia, serif;
            --font-body: 'Raleway', -apple-system, BlinkMacSystemFont, sans-serif;

            --space-xs: 0.25rem;
            --space-sm: 0.5rem;
            --space-md: 1rem;
            --space-lg: 2rem;
            --space-xl: 4rem;
            --space-2xl: 6rem;

            --max-width: 1200px;
            --radius: 0.5rem;
            --shadow: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 30px rgba(0,0,0,0.12);
            --transition: 0.3s ease;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html {
            scroll-behavior: smooth;
            -webkit-text-size-adjust: none;
            text-size-adjust: none;
        }

        body {
            font-family: var(--font-body);
            color: var(--black);
            line-height: 1.6;
            background: var(--white);
            -webkit-font-smoothing: antialiased;
        }

        img { max-width: 100%; height: auto; display: block; }
        ul[class], ol[class] { list-style: none; }
        p { text-wrap: pretty; }
        h1, h2, h3, h4, h5, h6 { text-wrap: balance; overflow-wrap: break-word; }
        input, button, textarea, select { font: inherit; }
        button { background: none; border: none; cursor: pointer; }

        .skip-link {
            position: absolute; top: -40px; left: 0;
            padding: 8px 16px; background: var(--gold); color: var(--white);
            z-index: 100; text-decoration: none;
        }
        .skip-link:focus { top: 0; }

        :focus-visible { outline: 3px solid var(--gold); outline-offset: 2px; }
        :focus:not(:focus-visible) { outline: none; }

        .sr-only {
            position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px;
            overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0;
        }

        .container {
            width: min(100% - var(--space-lg) * 2, var(--max-width));
            margin-inline: auto;
        }

        .section-title {
            font-family: var(--font-heading);
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            text-align: center;
            margin-bottom: var(--space-sm);
            color: var(--black);
        }

        .section-subtitle {
            text-align: center;
            color: var(--gray);
            font-size: 1.05rem;
            margin-bottom: var(--space-xl);
            font-weight: 300;
        }

        .gold-line {
            width: 60px; height: 3px;
            background: var(--gold);
            margin: var(--space-md) auto var(--space-lg);
            border: none;
        }

        .btn {
            display: inline-block; padding: 0.85rem 2.2rem;
            border-radius: var(--radius); font-weight: 600;
            text-decoration: none; font-size: 0.95rem;
            letter-spacing: 0.5px; text-transform: uppercase;
            transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
            min-height: 44px; min-width: 44px;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }

        .btn--gold { background: var(--gold); color: var(--white); }
        .btn--gold:hover { background: var(--gold-dark); }

        .btn--outline { background: transparent; border: 2px solid var(--white); color: var(--white); }
        .btn--outline:hover { background: var(--white); color: var(--black); }

        .btn--dark { background: var(--black); color: var(--white); }
        .btn--dark:hover { background: var(--black-light); }

        /* ========== NAVBAR ========== */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 50; padding: var(--space-md) 0;
            transition: background var(--transition), box-shadow var(--transition);
        }
        .navbar.scrolled {
            background: rgba(26,26,26,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }
        .navbar__inner {
            display: flex; justify-content: space-between; align-items: center;
        }
        .navbar__brand {
            font-family: var(--font-heading); font-size: 1.6rem;
            color: var(--gold); text-decoration: none; font-weight: 700;
        }
        .navbar__brand span { color: var(--white); font-weight: 300; }
        .nav-links {
            display: flex; gap: var(--space-lg); list-style: none;
        }
        .nav-links a {
            color: var(--white); text-decoration: none;
            font-size: 0.9rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: 1px;
            padding: var(--space-sm); transition: color var(--transition);
            position: relative;
        }
        .nav-links a::after {
            content: ''; position: absolute; bottom: 0; left: 50%;
            width: 0; height: 2px; background: var(--gold);
            transition: width var(--transition), left var(--transition);
        }
        .nav-links a:hover::after, .nav-links a:focus::after {
            width: 100%; left: 0;
        }
        .nav-links a:hover, .nav-links a:focus { color: var(--gold); }
        .nav-toggle {
            display: none; background: none; border: none;
            color: var(--white); font-size: 1.5rem; cursor: pointer;
            padding: var(--space-sm); min-height: 44px; min-width: 44px;
        }

        /* ========== HERO ========== */
        .hero {
            min-height: 100vh; display: flex; align-items: center;
            justify-content: center; text-align: center;
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
        }
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(201,168,76,0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(245,230,224,0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(201,168,76,0.1) 0%, transparent 50%);
        }
        .hero__content { position: relative; z-index: 1; padding: var(--space-xl) var(--space-lg); }
        .hero__tagline {
            font-family: var(--font-body); font-size: 0.95rem;
            color: var(--gold); text-transform: uppercase;
            letter-spacing: 4px; margin-bottom: var(--space-md);
            font-weight: 500;
        }
        .hero__title {
            font-family: var(--font-heading);
            font-size: clamp(2.5rem, 6vw, 5rem);
            color: var(--white); line-height: 1.15;
            margin-bottom: var(--space-lg);
        }
        .hero__title em {
            color: var(--gold); font-style: italic;
        }
        .hero__description {
            font-size: 1.15rem; color: rgba(255,255,255,0.7);
            max-width: 550px; margin: 0 auto var(--space-xl);
            font-weight: 300; line-height: 1.8;
        }
        .hero__buttons { display: flex; gap: var(--space-md); justify-content: center; flex-wrap: wrap; }
        .hero__scroll {
            position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
            color: var(--gold); text-decoration: none; font-size: 0.8rem;
            text-transform: uppercase; letter-spacing: 2px;
            display: flex; flex-direction: column; align-items: center; gap: var(--space-sm);
            animation: bounce 2s infinite;
        }
        .hero__scroll-arrow { font-size: 1.5rem; }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
            40% { transform: translateX(-50%) translateY(-8px); }
            60% { transform: translateX(-50%) translateY(-4px); }
        }

        /* ========== SERVICIOS ========== */
        .servicios { padding: var(--space-2xl) 0; background: var(--white); }
        .servicios__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-lg);
        }
        .servicio-card {
            padding: var(--space-xl) var(--space-lg);
            background: var(--white-off); border-radius: var(--radius);
            text-align: center; transition: transform var(--transition), box-shadow var(--transition);
            border: 1px solid transparent;
        }
        .servicio-card:hover {
            transform: translateY(-6px); box-shadow: var(--shadow-lg);
            border-color: var(--gold-light);
        }
        .servicio-card__icon {
            width: 70px; height: 70px; margin: 0 auto var(--space-lg);
            background: var(--pink); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; transition: background var(--transition);
        }
        .servicio-card:hover .servicio-card__icon { background: var(--gold); }
        .servicio-card:hover .servicio-card__icon svg { stroke: var(--white); }
        .servicio-card__icon svg { width: 32px; height: 32px; stroke: var(--gold-dark); stroke-width: 1.5; fill: none; }
        .servicio-card__title {
            font-family: var(--font-heading); font-size: 1.3rem;
            margin-bottom: var(--space-sm);
        }
        .servicio-card__text { color: var(--gray); font-size: 0.95rem; font-weight: 300; line-height: 1.7; }

        /* ========== SOBRE NOSOTROS ========== */
        .about { padding: var(--space-2xl) 0; background: var(--white-off); }
        .about__grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: var(--space-xl); align-items: center;
        }
        .about__image-wrapper {
            position: relative; border-radius: var(--radius); overflow: hidden;
            aspect-ratio: 4/5;
            background: linear-gradient(135deg, var(--pink) 0%, var(--gold-light) 100%);
        }
        .about__image-decor {
            position: absolute; inset: 20px;
            border: 2px solid var(--gold); border-radius: var(--radius);
        }
        .about__image-text {
            position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%);
            font-family: var(--font-heading); font-size: 3rem; color: rgba(255,255,255,0.3);
            white-space: nowrap;
        }
        .about__content h2 {
            font-family: var(--font-heading); font-size: clamp(1.8rem, 3vw, 2.5rem);
            margin-bottom: var(--space-sm);
        }
        .about__content .gold-line { margin-left: 0; }
        .about__content p {
            color: var(--gray); font-weight: 300; line-height: 1.8;
            margin-bottom: var(--space-md);
        }
        .about__stats {
            display: flex; gap: var(--space-xl); margin-top: var(--space-lg);
            padding-top: var(--space-lg); border-top: 1px solid var(--gray-light);
        }
        .stat__number {
            font-family: var(--font-heading); font-size: 2.5rem;
            color: var(--gold); line-height: 1;
        }
        .stat__label { font-size: 0.85rem; color: var(--gray); text-transform: uppercase; letter-spacing: 1px; }

        /* ========== GALERIA ========== */
        .galeria { padding: var(--space-2xl) 0; background: var(--white); }
        .galeria__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 250px);
            gap: var(--space-md);
        }
        .galeria__item {
            border-radius: var(--radius); overflow: hidden;
            position: relative; cursor: pointer;
            background: var(--pink);
            transition: transform var(--transition);
        }
        .galeria__item:nth-child(1) { grid-column: span 2; }
        .galeria__item:nth-child(4) { grid-column: span 2; }
        .galeria__item::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(26,26,26,0.6) 0%, transparent 60%);
            opacity: 0; transition: opacity var(--transition);
        }
        .galeria__item:hover::after { opacity: 1; }
        .galeria__item:hover { transform: scale(1.02); }
        .galeria__item-label {
            position: absolute; bottom: var(--space-md); left: var(--space-md);
            color: var(--white); font-size: 0.9rem; font-weight: 600;
            z-index: 1; opacity: 0; transition: opacity var(--transition);
            text-transform: uppercase; letter-spacing: 1px;
        }
        .galeria__item:hover .galeria__item-label { opacity: 1; }
        .galeria__placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-heading); font-size: 1.2rem; color: var(--gold-dark);
        }

        /* ========== TESTIMONIOS ========== */
        .testimonios { padding: var(--space-2xl) 0; background: var(--black); color: var(--white); }
        .testimonios .section-title { color: var(--white); }
        .testimonios .section-subtitle { color: rgba(255,255,255,0.5); }
        .testimonios__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: var(--space-lg);
        }
        .testimonio-card {
            background: var(--black-light); padding: var(--space-xl);
            border-radius: var(--radius); border: 1px solid rgba(201,168,76,0.15);
            transition: border-color var(--transition);
        }
        .testimonio-card:hover { border-color: var(--gold); }
        .testimonio-card__stars { color: var(--gold); font-size: 1.1rem; margin-bottom: var(--space-md); letter-spacing: 2px; }
        .testimonio-card__quote {
            font-style: italic; color: rgba(255,255,255,0.8);
            margin-bottom: var(--space-lg); line-height: 1.8; font-weight: 300;
        }
        .testimonio-card__author { display: flex; align-items: center; gap: var(--space-md); }
        .testimonio-card__avatar {
            width: 50px; height: 50px; border-radius: 50%;
            background: var(--gold); display: flex; align-items: center;
            justify-content: center; color: var(--white);
            font-weight: 700; font-family: var(--font-heading);
        }
        .testimonio-card__name { font-weight: 600; }
        .testimonio-card__role { font-size: 0.85rem; color: var(--gold); }

        /* ========== PRECIOS ========== */
        .precios { padding: var(--space-2xl) 0; background: var(--white-off); }
        .precios__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-lg);
        }
        .precio-card {
            background: var(--white); padding: var(--space-xl);
            border-radius: var(--radius); text-align: center;
            border: 1px solid var(--gray-light);
            transition: transform var(--transition), box-shadow var(--transition);
            position: relative; overflow: hidden;
        }
        .precio-card--featured {
            border-color: var(--gold); transform: scale(1.03);
        }
        .precio-card--featured::before {
            content: 'Popular'; position: absolute; top: 20px; right: -30px;
            background: var(--gold); color: var(--white); padding: 4px 40px;
            font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;
            transform: rotate(45deg); font-weight: 600;
        }
        .precio-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
        .precio-card--featured:hover { transform: translateY(-6px) scale(1.03); }
        .precio-card__name {
            font-family: var(--font-heading); font-size: 1.4rem;
            margin-bottom: var(--space-sm);
        }
        .precio-card__price {
            font-family: var(--font-heading); font-size: 2.8rem;
            color: var(--gold); margin-bottom: var(--space-sm);
        }
        .precio-card__price small { font-size: 0.9rem; color: var(--gray); font-family: var(--font-body); }
        .precio-card__divider {
            width: 40px; height: 2px; background: var(--gold);
            margin: var(--space-md) auto;
        }
        .precio-card__features {
            list-style: none; margin-bottom: var(--space-lg);
        }
        .precio-card__features li {
            padding: var(--space-sm) 0;
            color: var(--gray); font-size: 0.95rem; font-weight: 300;
            border-bottom: 1px solid var(--gray-light);
        }
        .precio-card__features li:last-child { border-bottom: none; }

        /* ========== EQUIPO ========== */
        .equipo { padding: var(--space-2xl) 0; background: var(--white); }
        .equipo__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: var(--space-lg);
        }
        .miembro-card { text-align: center; }
        .miembro-card__foto {
            width: 180px; height: 180px; border-radius: 50%;
            margin: 0 auto var(--space-lg);
            background: linear-gradient(135deg, var(--pink) 0%, var(--gold-light) 100%);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-heading); font-size: 2.5rem; color: var(--gold-dark);
            border: 3px solid var(--gold-light);
            transition: border-color var(--transition), transform var(--transition);
        }
        .miembro-card:hover .miembro-card__foto {
            border-color: var(--gold); transform: scale(1.05);
        }
        .miembro-card__nombre {
            font-family: var(--font-heading); font-size: 1.2rem;
            margin-bottom: var(--space-xs);
        }
        .miembro-card__rol { color: var(--gold); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: var(--space-sm); }
        .miembro-card__bio { color: var(--gray); font-size: 0.9rem; font-weight: 300; }

        /* ========== CONTACTO ========== */
        .contacto { padding: var(--space-2xl) 0; background: var(--white-off); }
        .contacto__grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: var(--space-xl);
        }
        .contacto__info h3 {
            font-family: var(--font-heading); font-size: 1.5rem;
            margin-bottom: var(--space-lg);
        }
        .contacto__item {
            display: flex; align-items: flex-start; gap: var(--space-md);
            margin-bottom: var(--space-lg);
        }
        .contacto__item-icon {
            width: 50px; height: 50px; min-width: 50px;
            background: var(--pink); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .contacto__item-icon svg { width: 22px; height: 22px; stroke: var(--gold-dark); stroke-width: 1.5; fill: none; }
        .contacto__item-label { font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: var(--gold-dark); }
        .contacto__item-text { color: var(--gray); font-weight: 300; }
        .contacto__horarios { margin-top: var(--space-lg); }
        .contacto__horarios h4 {
            font-family: var(--font-heading); font-size: 1.1rem;
            margin-bottom: var(--space-md);
        }
        .horario-row {
            display: flex; justify-content: space-between;
            padding: var(--space-sm) 0;
            border-bottom: 1px solid var(--gray-light);
            font-size: 0.9rem;
        }
        .horario-row span:first-child { font-weight: 500; }
        .horario-row span:last-child { color: var(--gray); }
        .contacto__form { background: var(--white); padding: var(--space-xl); border-radius: var(--radius); box-shadow: var(--shadow); }
        .contacto__form h3 {
            font-family: var(--font-heading); font-size: 1.5rem;
            margin-bottom: var(--space-lg);
        }
        .form-group { margin-bottom: var(--space-md); }
        .form-group label {
            display: block; font-size: 0.85rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px;
            margin-bottom: var(--space-xs); color: var(--black);
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; padding: 0.8rem 1rem;
            border: 1px solid var(--gray-light); border-radius: var(--radius);
            font-size: 0.95rem; transition: border-color var(--transition);
            background: var(--white-off);
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: var(--gold); outline: none;
            box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
        }
        .form-group textarea { resize: vertical; min-height: 120px; }
        .contacto__form .btn { width: 100%; text-align: center; }

        /* ========== CTA SECTION ========== */
        .cta-section {
            padding: var(--space-2xl) 0; text-align: center;
            background: linear-gradient(135deg, var(--black) 0%, var(--black-light) 100%);
            position: relative; overflow: hidden;
        }
        .cta-section::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at center, rgba(201,168,76,0.1) 0%, transparent 70%);
        }
        .cta-section__content { position: relative; z-index: 1; }
        .cta-section__title {
            font-family: var(--font-heading); font-size: clamp(1.8rem, 4vw, 3rem);
            color: var(--white); margin-bottom: var(--space-md);
        }
        .cta-section__title em { color: var(--gold); font-style: italic; }
        .cta-section__text {
            color: rgba(255,255,255,0.6); font-weight: 300;
            max-width: 500px; margin: 0 auto var(--space-lg);
        }

        /* ========== FOOTER ========== */
        .footer { background: var(--black); color: rgba(255,255,255,0.6); padding: var(--space-xl) 0 var(--space-lg); }
        .footer__grid {
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: var(--space-xl); margin-bottom: var(--space-xl);
        }
        .footer__brand {
            font-family: var(--font-heading); font-size: 1.5rem;
            color: var(--gold); margin-bottom: var(--space-md);
        }
        .footer__brand span { color: var(--white); font-weight: 300; }
        .footer__desc { font-size: 0.9rem; font-weight: 300; line-height: 1.8; }
        .footer h4 {
            color: var(--white); font-size: 0.9rem; text-transform: uppercase;
            letter-spacing: 1px; margin-bottom: var(--space-md);
        }
        .footer__links { list-style: none; }
        .footer__links li { margin-bottom: var(--space-sm); }
        .footer__links a {
            color: rgba(255,255,255,0.6); text-decoration: none;
            font-size: 0.9rem; font-weight: 300;
            transition: color var(--transition);
        }
        .footer__links a:hover { color: var(--gold); }
        .footer__social { display: flex; gap: var(--space-md); margin-top: var(--space-md); }
        .footer__social a {
            width: 40px; height: 40px; border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.2); display: flex;
            align-items: center; justify-content: center;
            color: rgba(255,255,255,0.6); text-decoration: none;
            transition: border-color var(--transition), color var(--transition), background var(--transition);
        }
        .footer__social a:hover { border-color: var(--gold); color: var(--gold); background: rgba(201,168,76,0.1); }
        .footer__social a svg { width: 18px; height: 18px; fill: currentColor; }
        .footer__bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: var(--space-lg); text-align: center;
            font-size: 0.85rem;
        }

        /* ========== LOGIN MODAL ========== */
        .navbar__login {
            color: var(--gold); border: 1px solid var(--gold);
            padding: 0.4rem 1.2rem; border-radius: var(--radius);
            font-size: 0.8rem; font-weight: 600; text-transform: uppercase;
            letter-spacing: 1px; cursor: pointer;
            transition: background var(--transition), color var(--transition);
            min-height: 44px; display: flex; align-items: center;
        }
        .navbar__login:hover { background: var(--gold); color: var(--white); }

        .login-overlay {
            position: fixed; inset: 0; z-index: 100;
            background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden;
            transition: opacity var(--transition), visibility var(--transition);
        }
        .login-overlay.active { opacity: 1; visibility: visible; }

        .login-modal {
            background: var(--white); border-radius: var(--radius);
            padding: var(--space-xl); width: min(90%, 420px);
            box-shadow: var(--shadow-lg); position: relative;
            transform: translateY(20px) scale(0.95);
            transition: transform var(--transition);
        }
        .login-overlay.active .login-modal {
            transform: translateY(0) scale(1);
        }
        .login-modal__close {
            position: absolute; top: var(--space-md); right: var(--space-md);
            font-size: 1.5rem; color: var(--gray); cursor: pointer;
            min-height: 44px; min-width: 44px;
            display: flex; align-items: center; justify-content: center;
        }
        .login-modal__close:hover { color: var(--black); }
        .login-modal__title {
            font-family: var(--font-heading); font-size: 1.6rem;
            text-align: center; margin-bottom: var(--space-xs);
        }
        .login-modal__subtitle {
            text-align: center; color: var(--gray); font-size: 0.9rem;
            font-weight: 300; margin-bottom: var(--space-lg);
        }
        .login-modal .form-group { margin-bottom: var(--space-md); }
        .login-modal .form-group label {
            display: block; font-size: 0.8rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px;
            margin-bottom: var(--space-xs); color: var(--black);
        }
        .login-modal .form-group input {
            width: 100%; padding: 0.8rem 1rem;
            border: 1px solid var(--gray-light); border-radius: var(--radius);
            font-size: 0.95rem; background: var(--white-off);
            transition: border-color var(--transition);
        }
        .login-modal .form-group input:focus {
            border-color: var(--gold); outline: none;
            box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
        }
        .login-modal__btn {
            width: 100%; padding: 0.85rem; border: none; border-radius: var(--radius);
            background: var(--gold); color: var(--white); font-weight: 600;
            font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;
            cursor: pointer; transition: background var(--transition);
            min-height: 44px;
        }
        .login-modal__btn:hover { background: var(--gold-dark); }
        .login-modal__btn:disabled { opacity: 0.6; cursor: not-allowed; }
        .login-modal__error {
            background: #fee; color: #c33; border: 1px solid #fcc;
            padding: 0.6rem 1rem; border-radius: var(--radius);
            font-size: 0.85rem; margin-bottom: var(--space-md);
            display: none; text-align: center;
        }
        .login-modal__error.visible { display: block; }
        .login-modal__spinner {
            display: inline-block; width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: var(--white); border-radius: 50%;
            animation: spin 0.6s linear infinite;
            margin-right: 0.5rem; vertical-align: middle;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ========== ANIMATIONS ========== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .animate.visible { opacity: 1; transform: translateY(0); }
        .animate-delay-1 { transition-delay: 0.1s; }
        .animate-delay-2 { transition-delay: 0.2s; }
        .animate-delay-3 { transition-delay: 0.3s; }
        .animate-delay-4 { transition-delay: 0.4s; }
        .animate-delay-5 { transition-delay: 0.5s; }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .galeria__grid { grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(3, 200px); }
            .galeria__item:nth-child(1) { grid-column: span 1; }
            .galeria__item:nth-child(4) { grid-column: span 1; }
            .footer__grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .navbar__login { font-size: 0.7rem; padding: 0.35rem 0.8rem; margin-right: 0.5rem; }
            .nav-toggle { display: flex; align-items: center; justify-content: center; }
            .nav-links {
                position: fixed; top: 0; right: -100%; width: 280px; height: 100vh;
                flex-direction: column; background: var(--black);
                padding: 5rem var(--space-xl) var(--space-xl);
                transition: right var(--transition);
                box-shadow: -5px 0 30px rgba(0,0,0,0.3);
            }
            .nav-links.active { right: 0; }
            .nav-close {
                position: absolute; top: var(--space-md); right: var(--space-md);
                color: var(--white); font-size: 1.5rem; background: none;
                border: none; cursor: pointer; min-height: 44px; min-width: 44px;
            }
            .about__grid { grid-template-columns: 1fr; }
            .about__image-wrapper { max-width: 400px; margin: 0 auto; }
            .about__stats { flex-direction: column; gap: var(--space-md); }
            .galeria__grid { grid-template-columns: 1fr; grid-template-rows: auto; }
            .galeria__item { min-height: 200px; }
            .contacto__grid { grid-template-columns: 1fr; }
            .footer__grid { grid-template-columns: 1fr; text-align: center; }
            .footer__social { justify-content: center; }
            .precio-card--featured { transform: none; }
            .precio-card--featured:hover { transform: translateY(-6px); }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            .animate { opacity: 1; transform: none; }
        }
    </style>
</head>
<body>
    <a href="#main" class="skip-link">Saltar al contenido principal</a>

    <!-- NAVBAR -->
    <header class="navbar" role="banner" id="navbar">
        <nav class="container navbar__inner" aria-label="Navegacion principal">
            <a href="#" class="navbar__brand">Glamour <span>Studio</span></a>
            <button class="nav-toggle" aria-expanded="false" aria-controls="nav-menu" aria-label="Abrir menu de navegacion">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
            <ul id="nav-menu" class="nav-links" role="list">
                <button class="nav-close" aria-label="Cerrar menu">&times;</button>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#nosotros">Nosotros</a></li>
                <li><a href="#galeria">Galeria</a></li>
                <li><a href="#precios">Precios</a></li>
                <li><a href="#equipo">Equipo</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
            <button class="navbar__login" id="btn-login" aria-label="Iniciar sesion">Iniciar Sesion</button>
        </nav>
    </header>

    <main id="main" role="main">
        <!-- HERO -->
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero__content">
                <p class="hero__tagline">Bienvenida a</p>
                <h1 id="hero-title" class="hero__title">Tu espacio de <em>belleza</em> y bienestar</h1>
                <p class="hero__description">
                    Descubre una experiencia unica donde el arte y la belleza se fusionan.
                    Nuestros expertos transformaran tu look con las ultimas tendencias.
                </p>
                <div class="hero__buttons">
                    <a href="#contacto" class="btn btn--gold">Reservar Cita</a>
                    <a href="#servicios" class="btn btn--outline">Ver Servicios</a>
                </div>
            </div>
            <a href="#servicios" class="hero__scroll" aria-label="Desplazar hacia abajo">
                <span>Descubre</span>
                <span class="hero__scroll-arrow" aria-hidden="true">&#8595;</span>
            </a>
        </section>

        <!-- SERVICIOS -->
        <section id="servicios" class="servicios" aria-labelledby="servicios-title">
            <div class="container">
                <h2 id="servicios-title" class="section-title animate">Nuestros Servicios</h2>
                <hr class="gold-line">
                <p class="section-subtitle animate animate-delay-1">Ofrecemos una amplia gama de servicios profesionales para realzar tu belleza natural</p>
                <div class="servicios__grid">
                    <article class="servicio-card animate animate-delay-1">
                        <div class="servicio-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M6 21V3M6 3C6 3 10 5 12 5C14 5 18 3 18 3V14C18 14 14 16 12 16C10 16 6 14 6 14"/></svg>
                        </div>
                        <h3 class="servicio-card__title">Cortes de Cabello</h3>
                        <p class="servicio-card__text">Cortes modernos y clasicos adaptados a tu estilo y tipo de rostro. Asesoramiento personalizado incluido.</p>
                    </article>
                    <article class="servicio-card animate animate-delay-2">
                        <div class="servicio-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 2C12 2 8 6 8 12C8 18 12 22 12 22"/><path d="M12 2C12 2 16 6 16 12C16 18 12 22 12 22"/><line x1="2" y1="12" x2="22" y2="12"/></svg>
                        </div>
                        <h3 class="servicio-card__title">Coloracion</h3>
                        <p class="servicio-card__text">Tintes, mechas, balayage y tecnicas de color avanzadas con productos de primera calidad.</p>
                    </article>
                    <article class="servicio-card animate animate-delay-3">
                        <div class="servicio-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M12 22C6.5 22 2 17.5 2 12S6.5 2 12 2s10 4.5 10 10-4.5 10-10 10z"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                        </div>
                        <h3 class="servicio-card__title">Maquillaje</h3>
                        <p class="servicio-card__text">Maquillaje profesional para eventos, novias, sesiones fotograficas y looks de dia o noche.</p>
                    </article>
                    <article class="servicio-card animate animate-delay-1">
                        <div class="servicio-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"/><path d="M12 6V12L16 14"/></svg>
                        </div>
                        <h3 class="servicio-card__title">Tratamientos Capilares</h3>
                        <p class="servicio-card__text">Keratina, hidratacion profunda, reparacion y tratamientos anticaida para un cabello saludable.</p>
                    </article>
                    <article class="servicio-card animate animate-delay-2">
                        <div class="servicio-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        </div>
                        <h3 class="servicio-card__title">Manicure y Pedicure</h3>
                        <p class="servicio-card__text">Unas gel, acrilicas, semi-permanente y nail art. Cuidado completo de manos y pies.</p>
                    </article>
                    <article class="servicio-card animate animate-delay-3">
                        <div class="servicio-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M9.5 2A2.5 2.5 0 0 1 12 4.5V5a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.5A2.5 2.5 0 0 1 5.5 2h4Z"/><path d="M3 6h8v4a4 4 0 0 1-8 0V6Z"/><path d="M7 14v3"/><path d="M4 17h6"/><path d="M18 6a4 4 0 0 1 0 8"/><path d="M22 6a8 8 0 0 1-5 7.5"/></svg>
                        </div>
                        <h3 class="servicio-card__title">Depilacion</h3>
                        <p class="servicio-card__text">Depilacion con cera, laser y tecnicas avanzadas para una piel suave y libre de vello.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- SOBRE NOSOTROS -->
        <section id="nosotros" class="about" aria-labelledby="about-title">
            <div class="container">
                <div class="about__grid">
                    <div class="about__image-wrapper animate">
                        <div class="about__image-decor"></div>
                        <div class="about__image-text">Glamour</div>
                    </div>
                    <div class="about__content animate animate-delay-2">
                        <h2 id="about-title">Donde la belleza se convierte en arte</h2>
                        <hr class="gold-line">
                        <p>
                            En Glamour Studio creemos que cada persona merece sentirse especial.
                            Con mas de 10 anos de experiencia, nuestro equipo de profesionales
                            altamente capacitados se dedica a realzar tu belleza natural.
                        </p>
                        <p>
                            Utilizamos productos de las mejores marcas del mercado y estamos
                            constantemente actualizandonos con las ultimas tendencias y tecnicas
                            para ofrecerte resultados excepcionales.
                        </p>
                        <div class="about__stats">
                            <div>
                                <div class="stat__number">10+</div>
                                <div class="stat__label">Anos de experiencia</div>
                            </div>
                            <div>
                                <div class="stat__number">5K+</div>
                                <div class="stat__label">Clientes felices</div>
                            </div>
                            <div>
                                <div class="stat__number">15+</div>
                                <div class="stat__label">Profesionales</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- GALERIA -->
        <section id="galeria" class="galeria" aria-labelledby="galeria-title">
            <div class="container">
                <h2 id="galeria-title" class="section-title animate">Nuestra Galeria</h2>
                <hr class="gold-line">
                <p class="section-subtitle animate animate-delay-1">Inspira tu proximo look con nuestros trabajos</p>
                <div class="galeria__grid">
                    <div class="galeria__item animate" role="img" aria-label="Coloracion balayage">
                        <div class="galeria__placeholder">Coloracion</div>
                        <span class="galeria__item-label">Balayage</span>
                    </div>
                    <div class="galeria__item animate animate-delay-1" role="img" aria-label="Corte moderno">
                        <div class="galeria__placeholder">Cortes</div>
                        <span class="galeria__item-label">Corte Moderno</span>
                    </div>
                    <div class="galeria__item animate animate-delay-2" role="img" aria-label="Maquillaje profesional">
                        <div class="galeria__placeholder">Maquillaje</div>
                        <span class="galeria__item-label">Maquillaje Novia</span>
                    </div>
                    <div class="galeria__item animate animate-delay-3" role="img" aria-label="Manicure y nail art">
                        <div class="galeria__placeholder">Manicure</div>
                        <span class="galeria__item-label">Nail Art</span>
                    </div>
                    <div class="galeria__item animate animate-delay-4" role="img" aria-label="Tratamiento capilar">
                        <div class="galeria__placeholder">Tratamientos</div>
                        <span class="galeria__item-label">Keratina</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTIMONIOS -->
        <section id="testimonios" class="testimonios" aria-labelledby="testimonios-title">
            <div class="container">
                <h2 id="testimonios-title" class="section-title animate">Lo que dicen nuestras clientas</h2>
                <hr class="gold-line">
                <p class="section-subtitle animate animate-delay-1">La satisfaccion de nuestras clientas es nuestra mejor carta de presentacion</p>
                <div class="testimonios__grid">
                    <article class="testimonio-card animate animate-delay-1">
                        <div class="testimonio-card__stars" aria-label="5 estrellas">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <blockquote class="testimonio-card__quote">
                            "El mejor salon al que he ido. Mi coloracion quedo perfecta y el trato es increible. Siempre salgo sintiendome renovada."
                        </blockquote>
                        <footer class="testimonio-card__author">
                            <div class="testimonio-card__avatar" aria-hidden="true">MC</div>
                            <div>
                                <div class="testimonio-card__name">Maria Castellanos</div>
                                <div class="testimonio-card__role">Cliente frecuente</div>
                            </div>
                        </footer>
                    </article>
                    <article class="testimonio-card animate animate-delay-2">
                        <div class="testimonio-card__stars" aria-label="5 estrellas">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <blockquote class="testimonio-card__quote">
                            "Me hicieron el maquillaje para mi boda y quede espectacular. Todas mis invitadas me preguntaron donde me habia arreglado."
                        </blockquote>
                        <footer class="testimonio-card__author">
                            <div class="testimonio-card__avatar" aria-hidden="true">LR</div>
                            <div>
                                <div class="testimonio-card__name">Laura Rodriguez</div>
                                <div class="testimonio-card__role">Novia 2024</div>
                            </div>
                        </footer>
                    </article>
                    <article class="testimonio-card animate animate-delay-3">
                        <div class="testimonio-card__stars" aria-label="5 estrellas">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <blockquote class="testimonio-card__quote">
                            "El tratamiento de keratina transformo mi cabello por completo. De inmanejable a sedoso en una sola sesion. 100% recomendado."
                        </blockquote>
                        <footer class="testimonio-card__author">
                            <div class="testimonio-card__avatar" aria-hidden="true">AP</div>
                            <div>
                                <div class="testimonio-card__name">Andrea Perez</div>
                                <div class="testimonio-card__role">Cliente desde 2020</div>
                            </div>
                        </footer>
                    </article>
                </div>
            </div>
        </section>

        <!-- PRECIOS -->
        <section id="precios" class="precios" aria-labelledby="precios-title">
            <div class="container">
                <h2 id="precios-title" class="section-title animate">Nuestros Planes</h2>
                <hr class="gold-line">
                <p class="section-subtitle animate animate-delay-1">Elige el paquete que mejor se adapte a tus necesidades</p>
                <div class="precios__grid">
                    <article class="precio-card animate animate-delay-1">
                        <h3 class="precio-card__name">Esencial</h3>
                        <div class="precio-card__price">$35 <small>/ sesion</small></div>
                        <div class="precio-card__divider"></div>
                        <ul class="precio-card__features">
                            <li>Corte de cabello</li>
                            <li>Lavado y secado</li>
                            <li>Peinado basico</li>
                            <li>Asesoramiento de estilo</li>
                        </ul>
                        <a href="#contacto" class="btn btn--dark">Reservar</a>
                    </article>
                    <article class="precio-card precio-card--featured animate animate-delay-2">
                        <h3 class="precio-card__name">Premium</h3>
                        <div class="precio-card__price">$75 <small>/ sesion</small></div>
                        <div class="precio-card__divider"></div>
                        <ul class="precio-card__features">
                            <li>Corte + Coloracion</li>
                            <li>Tratamiento hidratante</li>
                            <li>Peinado completo</li>
                            <li>Manicure basico incluido</li>
                        </ul>
                        <a href="#contacto" class="btn btn--gold">Reservar</a>
                    </article>
                    <article class="precio-card animate animate-delay-3">
                        <h3 class="precio-card__name">Glamour VIP</h3>
                        <div class="precio-card__price">$120 <small>/ sesion</small></div>
                        <div class="precio-card__divider"></div>
                        <ul class="precio-card__features">
                            <li>Todos los servicios Premium</li>
                            <li>Maquillaje profesional</li>
                            <li>Manicure + Pedicure gel</li>
                            <li>Tratamiento capilar premium</li>
                        </ul>
                        <a href="#contacto" class="btn btn--dark">Reservar</a>
                    </article>
                </div>
            </div>
        </section>

        <!-- EQUIPO -->
        <section id="equipo" class="equipo" aria-labelledby="equipo-title">
            <div class="container">
                <h2 id="equipo-title" class="section-title animate">Nuestro Equipo</h2>
                <hr class="gold-line">
                <p class="section-subtitle animate animate-delay-1">Profesionales apasionados por la belleza</p>
                <div class="equipo__grid">
                    <article class="miembro-card animate animate-delay-1">
                        <div class="miembro-card__foto" aria-hidden="true">VS</div>
                        <h3 class="miembro-card__nombre">Valentina Suarez</h3>
                        <p class="miembro-card__rol">Directora Creativa</p>
                        <p class="miembro-card__bio">Especialista en colorimetria con 12 anos de experiencia internacional.</p>
                    </article>
                    <article class="miembro-card animate animate-delay-2">
                        <div class="miembro-card__foto" aria-hidden="true">CM</div>
                        <h3 class="miembro-card__nombre">Camila Martinez</h3>
                        <p class="miembro-card__rol">Estilista Senior</p>
                        <p class="miembro-card__bio">Experta en cortes de tendencia y transformaciones de imagen.</p>
                    </article>
                    <article class="miembro-card animate animate-delay-3">
                        <div class="miembro-card__foto" aria-hidden="true">IG</div>
                        <h3 class="miembro-card__nombre">Isabella Gomez</h3>
                        <p class="miembro-card__rol">Maquilladora Profesional</p>
                        <p class="miembro-card__bio">Artista del maquillaje especializada en novias y eventos especiales.</p>
                    </article>
                    <article class="miembro-card animate animate-delay-4">
                        <div class="miembro-card__foto" aria-hidden="true">DL</div>
                        <h3 class="miembro-card__nombre">Daniela Lopez</h3>
                        <p class="miembro-card__rol">Nail Artist</p>
                        <p class="miembro-card__bio">Creadora de disenos unicos en unas con tecnicas de vanguardia.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- CONTACTO -->
        <section id="contacto" class="contacto" aria-labelledby="contacto-title">
            <div class="container">
                <h2 id="contacto-title" class="section-title animate">Contactanos</h2>
                <hr class="gold-line">
                <p class="section-subtitle animate animate-delay-1">Estamos aqui para atenderte. Reserva tu cita hoy</p>
                <div class="contacto__grid">
                    <div class="contacto__info animate animate-delay-1">
                        <h3>Informacion de Contacto</h3>
                        <div class="contacto__item">
                            <div class="contacto__item-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <div class="contacto__item-label">Direccion</div>
                                <div class="contacto__item-text">Calle Principal #123, Centro<br>Ciudad, CP 12345</div>
                            </div>
                        </div>
                        <div class="contacto__item">
                            <div class="contacto__item-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <div class="contacto__item-label">Telefono</div>
                                <div class="contacto__item-text">+57 300 123 4567</div>
                            </div>
                        </div>
                        <div class="contacto__item">
                            <div class="contacto__item-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div>
                                <div class="contacto__item-label">Email</div>
                                <div class="contacto__item-text">info@glamourstudio.com</div>
                            </div>
                        </div>
                        <div class="contacto__horarios">
                            <h4>Horario de Atencion</h4>
                            <div class="horario-row"><span>Lunes - Viernes</span><span>9:00 AM - 7:00 PM</span></div>
                            <div class="horario-row"><span>Sabados</span><span>9:00 AM - 5:00 PM</span></div>
                            <div class="horario-row"><span>Domingos</span><span>10:00 AM - 3:00 PM</span></div>
                        </div>
                    </div>
                    <div class="contacto__form animate animate-delay-2">
                        <h3>Reserva tu Cita</h3>
                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre completo</label>
                                <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electronico</label>
                                <input type="email" id="email" name="email" required placeholder="tu@email.com">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="tel" id="telefono" name="telefono" placeholder="+57 300 000 0000">
                            </div>
                            <div class="form-group">
                                <label for="servicio">Servicio</label>
                                <select id="servicio" name="servicio" required>
                                    <option value="">Selecciona un servicio</option>
                                    <option value="corte">Corte de cabello</option>
                                    <option value="coloracion">Coloracion</option>
                                    <option value="maquillaje">Maquillaje</option>
                                    <option value="tratamiento">Tratamiento capilar</option>
                                    <option value="manicure">Manicure / Pedicure</option>
                                    <option value="depilacion">Depilacion</option>
                                    <option value="paquete">Paquete completo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mensaje">Mensaje</label>
                                <textarea id="mensaje" name="mensaje" placeholder="Cuentanos que necesitas..."></textarea>
                            </div>
                            <button type="submit" class="btn btn--gold">Enviar Solicitud</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta-section" aria-labelledby="cta-title">
            <div class="container cta-section__content">
                <h2 id="cta-title" class="cta-section__title animate">Tu <em>transformacion</em> comienza hoy</h2>
                <p class="cta-section__text animate animate-delay-1">Reserva tu primera cita y recibe un 20% de descuento en cualquier servicio</p>
                <a href="#contacto" class="btn btn--gold animate animate-delay-2">Reservar Ahora</a>
            </div>
        </section>
    </main>

    <!-- LOGIN MODAL -->
    <div class="login-overlay" id="login-overlay" role="dialog" aria-modal="true" aria-labelledby="login-title">
        <div class="login-modal">
            <button class="login-modal__close" id="login-close" aria-label="Cerrar">&times;</button>
            <h2 class="login-modal__title" id="login-title">Bienvenido</h2>
            <p class="login-modal__subtitle">Ingresa a tu panel de administracion</p>
            <div class="login-modal__error" id="login-error"></div>
            <form id="login-form">
                <div class="form-group">
                    <label for="login-user">Usuario o Correo</label>
                    <input type="text" id="login-user" name="name_email" required placeholder="tu@email.com" autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="login-pass">Contrasena</label>
                    <input type="password" id="login-pass" name="password" required placeholder="Tu contrasena" autocomplete="current-password">
                </div>
                <button type="submit" class="login-modal__btn" id="login-submit">Iniciar Sesion</button>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer" role="contentinfo">
        <div class="container">
            <div class="footer__grid">
                <div>
                    <div class="footer__brand">Glamour <span>Studio</span></div>
                    <p class="footer__desc">Tu destino de belleza y bienestar. Transformamos tu imagen con pasion y profesionalismo desde hace mas de 10 anos.</p>
                    <div class="footer__social">
                        <a href="#" aria-label="Facebook">
                            <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                        <a href="#" aria-label="Instagram">
                            <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.5"/></svg>
                        </a>
                        <a href="#" aria-label="WhatsApp">
                            <svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4>Servicios</h4>
                    <ul class="footer__links">
                        <li><a href="#servicios">Cortes</a></li>
                        <li><a href="#servicios">Coloracion</a></li>
                        <li><a href="#servicios">Maquillaje</a></li>
                        <li><a href="#servicios">Tratamientos</a></li>
                        <li><a href="#servicios">Manicure</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Empresa</h4>
                    <ul class="footer__links">
                        <li><a href="#nosotros">Sobre nosotros</a></li>
                        <li><a href="#equipo">Nuestro equipo</a></li>
                        <li><a href="#galeria">Galeria</a></li>
                        <li><a href="#testimonios">Testimonios</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Contacto</h4>
                    <ul class="footer__links">
                        <li><a href="tel:+573001234567">+57 300 123 4567</a></li>
                        <li><a href="mailto:info@glamourstudio.com">info@glamourstudio.com</a></li>
                        <li><a href="#contacto">Reservar cita</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom">
                <p>&copy; {{ date('Y') }} Glamour Studio. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        }, { passive: true });

        // Mobile menu toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.getElementById('nav-menu');
        const navClose = document.querySelector('.nav-close');

        navToggle?.addEventListener('click', () => {
            navMenu.classList.add('active');
            navToggle.setAttribute('aria-expanded', 'true');
        });

        navClose?.addEventListener('click', () => {
            navMenu.classList.remove('active');
            navToggle.setAttribute('aria-expanded', 'false');
        });

        // Close menu on link click
        navMenu?.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });

        // Scroll animations with IntersectionObserver
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.animate').forEach(el => observer.observe(el));

        // Login modal
        const loginOverlay = document.getElementById('login-overlay');
        const btnLogin = document.getElementById('btn-login');
        const loginClose = document.getElementById('login-close');
        const loginForm = document.getElementById('login-form');
        const loginError = document.getElementById('login-error');
        const loginSubmit = document.getElementById('login-submit');

        // Si ya hay sesion, cambiar boton a "Ir al Panel"
        if (localStorage.getItem('auth_token')) {
            btnLogin.textContent = 'Mi Panel';
        }

        btnLogin.addEventListener('click', () => {
            if (localStorage.getItem('auth_token')) {
                window.location.href = '/admin/';
                return;
            }
            loginOverlay.classList.add('active');
            document.getElementById('login-user').focus();
        });

        loginClose.addEventListener('click', () => {
            loginOverlay.classList.remove('active');
            loginError.classList.remove('visible');
        });

        loginOverlay.addEventListener('click', (e) => {
            if (e.target === loginOverlay) {
                loginOverlay.classList.remove('active');
                loginError.classList.remove('visible');
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && loginOverlay.classList.contains('active')) {
                loginOverlay.classList.remove('active');
                loginError.classList.remove('visible');
            }
        });

        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            loginError.classList.remove('visible');
            loginSubmit.disabled = true;
            loginSubmit.innerHTML = '<span class="login-modal__spinner"></span>Ingresando...';

            try {
                const res = await fetch('/api/auth', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name_email: document.getElementById('login-user').value.trim(),
                        password: document.getElementById('login-pass').value
                    })
                });

                const data = await res.json();

                if (data.status && data.data && data.data.token) {
                    localStorage.setItem('auth_token', data.data.token);
                    localStorage.setItem('auth_user', JSON.stringify(data.data.user));
                    window.location.href = '/admin/';
                } else {
                    loginError.textContent = data.message || 'Credenciales incorrectas';
                    loginError.classList.add('visible');
                }
            } catch (err) {
                loginError.textContent = 'Error de conexion. Intenta nuevamente.';
                loginError.classList.add('visible');
            } finally {
                loginSubmit.disabled = false;
                loginSubmit.textContent = 'Iniciar Sesion';
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    const offset = navbar.offsetHeight + 10;
                    const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({ top, behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
