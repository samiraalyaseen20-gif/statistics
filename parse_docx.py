import docx

def read_tables(file_path):
    print(f"Reading {file_path}")
    doc = docx.Document(file_path)
    for i, table in enumerate(doc.tables):
        print(f"Table {i}:")
        for j, row in enumerate(table.rows):
            if j > 3: # limit to first few rows
                print("...")
                break
            cells = [cell.text.strip().replace('\n', ' ') for cell in row.cells]
            print(cells)
        print("-" * 20)

file1 = r"d:\smira progickt\New folder\احصائية_تفصيلية_لكل_طبيب_ايار_2026_.docx"
file2 = r"d:\smira progickt\New folder\شهر5عتبة2026.docx"

read_tables(file1)
read_tables(file2)
