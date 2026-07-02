import pdfplumber
import sys
import json

file_path = r"d:\smira progickt\احصائية_تفصيلية_لكل_طبيب_ايار_2026_.pdf"
print(f"Reading {file_path}")
try:
    with pdfplumber.open(file_path) as pdf:
        print(f"Total pages: {len(pdf.pages)}")
        # Read the first page to see the structure
        page = pdf.pages[0]
        text = page.extract_text()
        tables = page.extract_tables()
        
        print("\n--- TEXT FROM PAGE 1 ---")
        print(text)
        
        print("\n--- TABLES FROM PAGE 1 ---")
        for idx, table in enumerate(tables):
            print(f"Table {idx}:")
            for row in table:
                print(row)
except Exception as e:
    print(f"Error: {e}")
