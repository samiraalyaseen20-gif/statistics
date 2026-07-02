import os

def update_file(path):
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    new_str = 'months_files = {\n    "1": {"type1": "احصائية_تفصيلية_لكل_طبيب_يناير_2026_.docx", "type2": "شهر 1 2026.docx"},'
    
    if '"1"' not in content:
        content = content.replace('months_files = {', new_str)
        with open(path, 'w', encoding='utf-8') as f:
            f.write(content)

update_file(r'd:\smira progickt\statistics\extract_all.py')
update_file(r'd:\smira progickt\statistics\fix_json.py')
