<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مرفقات الصرف</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .actions {
            text-align: center;
            margin-bottom: 20px;
        }

        .actions button {
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            margin: 0 5px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
        }

        .item {
            background: white;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .item img {
            max-width: 100%;
            height: 200px;
            object-fit: contain;
        }

        iframe {
            width: 100%;
            height: 200px;
            border: none;
        }

        .print-single {
            margin-top: 10px;
            background: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        @media print {
            .actions,
            .print-single {
                display: none;
            }

            .item {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
@php
    use Illuminate\Support\Facades\Storage;

    $attachments = [];

    /**
     * صورة مباشرة في جدول sarf
     */
    if ($sarf->img) {
        $attachments[] = [
            'type' => 'image',
            'url' => Storage::url($sarf->img),
        ];
    }

    /**
     * ملفات متعددة
     */
    if ($sarf->files) {
        foreach ($sarf->files as $file) {
            $isPdf = str_ends_with(strtolower($file->url), '.pdf');

            $attachments[] = [
                'type' => $isPdf ? 'pdf' : 'image',
                'url' => Storage::url($file->url),
            ];
        }
    }
@endphp


<div class="actions">
    <button onclick="printAll()">🖨️ طباعة جميع المرفقات</button>

    <button onclick="window.close()">❌ إغلاق</button>
</div>

<div class="gallery">

    @foreach($attachments as $index => $file)
        <div class="item" id="item-{{ $index }}">



                <div class="item"
                     data-print-url="{{ $file['url'] }}"
                     data-type="{{ $file['type'] }}">

                    @if($file['type'] === 'image')
                        <img src="{{ $file['url'] }}">
                        <button class="print-single"
                                onclick="printImage('{{ $file['url'] }}')">
                            🖨️ طباعة
                        </button>
                    @else
                        <iframe src="{{ $file['url'] }}"></iframe>
                        <button class="print-single"
                                onclick="printPDF('{{ $file['url'] }}')">
                            🖨️ طباعة
                        </button>
                    @endif
                </div>

        </div>
    @endforeach

</div>
<script>
    function printImage(url) {
        const win = window.open('', '', 'width=900,height=650');

        win.document.write(`
            <html lang="ar">
            <head>
                <title>طباعة</title>
                <style>
                    body {
                        margin: 0;
                        text-align: center;
                    }
                    img {
                        max-width: 100%;
                        max-height: 100vh;
                    }
                </style>
            </head>
            <body onload="window.print(); window.close();">
                <img src="${url}">
            </body>
            </html>
        `);

        win.document.close();
    }

    function printPDF(url) {
        const win = window.open(url, '_blank');
        win.focus();
        win.print();
    }

    function printAll() {
        const items = document.querySelectorAll('[data-print-url]');
        let index = 0;

        function printNext() {
            if (index >= items.length) return;

            const url = items[index].dataset.printUrl;
            const type = items[index].dataset.type;
            index++;

            let win;

            if (type === 'image') {
                win = window.open('', '', 'width=900,height=650');
                win.document.write(`
                    <html>
                    <body onload="window.print(); window.close();">
                        <img src="${url}" style="max-width:100%;max-height:100vh;">
                    </body>
                    </html>
                `);
                win.document.close();
            } else {
                win = window.open(url, '_blank');
                win.print();
            }

            setTimeout(printNext, 1200);
        }

        printNext();
    }
</script>

</body>
</html>
