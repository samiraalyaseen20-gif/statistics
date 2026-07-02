import docx, sys, io
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
doc = docx.Document(r'd:\smira progickt\New folder\شهر 2 2026.docx')
for i, table in enumerate(doc.tables):
    if len(table.rows) > 0:
        print(f'Table {i} headers: {[c.text.strip().replace(chr(10), " ") for c in table.rows[0].cells]}')
