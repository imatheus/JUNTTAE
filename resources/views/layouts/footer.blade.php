<footer class="site-footer">
    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="footer-title">JUNTTAÊ</span>
                <span class="footer-copy">© {{ date('Y') }} — Todos os direitos reservados.</span>
            </div>
            <div class="footer-links">
                <a href="{{ route('home') }}">Eventos</a>
                @auth
                    <a href="{{ route('client.my-tickets') }}">Meus Ingressos</a>
                @endauth
            </div>
        </div>
    </div>
</footer>
