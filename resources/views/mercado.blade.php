<x-app-layout>
    <div id="grafica" class="h-auto" >
        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
        <script type="text/javascript">
        new TradingView.widget({
        "autosize": false,
        "symbol": "BTCEUR",
        "interval": "1H",
        "timezone": "Etc/UTC",
        "theme": "Dark",
        "style": "1",
        "locale": "es",
        "toolbar_bg": "#f1f3f6",
        "enable_publishing": false,
        "allow_symbol_change": true,
        "hideideas": true
        });
        </script>
    </div>
</x-app-layout>
